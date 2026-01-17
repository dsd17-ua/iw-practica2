<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SocioController extends Controller
{
    public function getActividades(Request $request)
    {
        // Si el usuario tiene que renovar, redirigir a pagina de error
        $usuario = Auth::user();
        $proximaRenovacion = $usuario->proxima_renovacion
            ? Carbon::parse($usuario->proxima_renovacion)
            : Carbon::parse($usuario->created_at)->addMonth();
        if ($proximaRenovacion && $proximaRenovacion <= now()) {
            return redirect()->route('socio.plan.renovar');
        }

        $actividadesDisponibles = DB::table('actividades')->orderBy('nombre')->get();

        // Obtener las clases disponibles y poner su disponibilidad.
        // Ordenar por fecha
        $listadoActividades = DB::table('clases')
            ->join('actividades', 'clases.actividad_id', '=', 'actividades.id')
            ->leftJoin('salas', 'clases.sala_id', '=', 'salas.id')
            ->leftJoin('users as monitor', 'clases.monitor_id', '=', 'monitor.id')
            ->where('clases.fecha_inicio', '>', now())
            ->whereRaw('clases.asistencia_actual < clases.plazas_totales')
            ->orderBy('clases.fecha_inicio', 'asc')
            ->select(
                'clases.*',
                'actividades.nombre as actividad_nombre',
                'clases.coste_extra as clase_precio',
                'salas.nombre as sala_nombre',
                DB::raw("CONCAT(monitor.nombre, ' ', COALESCE(monitor.apellidos, '')) as monitor_nombre")
            )
            ->get();

        return view('socio.actividades', compact('actividadesDisponibles', 'listadoActividades'));
    }

    public function reservarActividad(Request $request, $claseId)
    {
        $usuario = Auth::user();

        // Verificar si el usuario puede gastar una clase gratuita
        $claseGratuitaDisponible = DB::table('reservas')
            ->join('clases', 'reservas.clase_id', '=', 'clases.id')
            ->where('user_id', $usuario->id)
            ->where('uso_clase_gratuita', true)
            ->where('reservas.estado', '!=', 'cancelada')
            ->whereBetween('clases.fecha_inicio', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ])
            ->count() < DB::table('planes')
                ->where('id', $usuario->plan_id)
                ->value('clases_gratis_incluidas');

        $precioClase = DB::table('clases')->where('id', $claseId)->value('coste_extra');

        // Verificar si el usuario tiene saldo suficiente si no usa clase gratuita
        if (!$claseGratuitaDisponible) {
            $saldoUsuario = DB::table('users')->where('id', $usuario->id)->value('saldo_actual');
            if ($saldoUsuario < $precioClase) {
                return back()->with('error', 'Saldo insuficiente para reservar esta actividad.');
            }
        }

        // Actualizar el saldo del usuario si paga por la clase
        DB::table('users')
            ->where('id', $usuario->id)
            ->update(['saldo_actual' => DB::raw('saldo_actual - ' . ($claseGratuitaDisponible ? 0 : $precioClase))]);

        // Registrar la reserva
        DB::table('reservas')->insert([
            'user_id' => $usuario->id,
            'clase_id' => $claseId,
            'fecha_reserva' => now(),
            'uso_clase_gratuita' => $claseGratuitaDisponible,
            'precio_pagado' => $claseGratuitaDisponible ? 0 : $precioClase,
            'estado' => 'confirmada',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Actualizar el aforo actual de la clase
        DB::table('clases')
            ->where('id', $claseId)
            ->increment('asistencia_actual');
        
        // Registrar la transacción si se ha pagado por la clase
        if (!$claseGratuitaDisponible) {
            DB::table('transacciones')->insert([
                'user_id' => $usuario->id,
                'fecha' => now(),
                'monto' => -$precioClase,
                'tipo' => 'reserva de clase',
                'concepto' => 'Reserva de clase ID ' . $claseId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('socio.reservas')->with('success', 'Actividad reservada correctamente.');
    }

    public function getReservas(Request $request)
    {
        $usuario = Auth::user();

        // Si el usuario tiene que renovar, redirigir a pagina de error
        $proximaRenovacion = $usuario->proxima_renovacion
            ? Carbon::parse($usuario->proxima_renovacion)
            : Carbon::parse($usuario->created_at)->addMonth();
        if ($proximaRenovacion && $proximaRenovacion <= now()) {
            return redirect()->route('socio.plan.renovar');
        }

        // Actualizar el estado de las reservas basándose en la fecha actual
        DB::table('reservas')
            ->join('clases', 'reservas.clase_id', '=', 'clases.id')
            ->where('reservas.user_id', '=', $usuario->id)
            ->where('clases.fecha_fin', '<', now())
            ->where('reservas.estado', '=', 'reservada')
            ->update(['reservas.estado' => 'asistida', 'reservas.updated_at' => now()]);

        // Obtener las reservas del usuario
        $reservas = DB::table('reservas')
            ->join('clases', 'reservas.clase_id', '=', 'clases.id')
            ->join('actividades', 'clases.actividad_id', '=', 'actividades.id')
            ->join('salas', 'clases.sala_id', '=', 'salas.id')
            ->leftJoin('users as monitor', 'clases.monitor_id', '=', 'monitor.id')
            ->where('reservas.user_id', '=', $usuario->id)
            ->orderByDesc(DB::raw("COALESCE(clases.fecha_inicio, reservas.fecha_reserva)"))
            ->select(
                'reservas.*',
                'clases.fecha_inicio',
                'clases.fecha_fin',
                'actividades.nombre as actividad_nombre',
                'salas.nombre as sala_nombre',
                DB::raw("CONCAT(monitor.nombre, ' ', COALESCE(monitor.apellidos, '')) as monitor_nombre"),
                DB::raw("COALESCE(clases.fecha_inicio, reservas.fecha_reserva) as fecha_clase")
            )
            ->get();
        return view('socio.reservas', compact('reservas'));
    }

    public function cancelarReserva(Request $request, $reservaId)
    {
        $usuario = Auth::user();

        // Verificar que la reserva pertenece al usuario y existe
        $reserva = DB::table('reservas')
            ->where('id', $reservaId)
            ->where('user_id', $usuario->id)
            ->first();

        if (!$reserva) {
            return redirect()->route('socio.reservas')->with('error', 'Reserva no encontrada.');
        }

        // Actualizar el estado de la reserva a cancelada
        DB::table('reservas')
            ->where('id', $reservaId)
            ->update([
                'estado' => 'cancelada',
                'updated_at' => now()
            ]);
        
        // Actualizar el aforo actual de la clase
        DB::table('clases')
            ->where('id', $reserva->clase_id)
            ->decrement('asistencia_actual');

        // Reembolso del importe al saldo del socio
        if ($reserva->precio_pagado > 0) {
            DB::table('users')
                ->where('id', $usuario->id)
                ->update(['saldo_actual' => DB::raw('saldo_actual + ' . $reserva->precio_pagado)]);

            DB::table('transacciones')->insert([
                'user_id' => $usuario->id,
                'fecha' => now(),
                'monto' => $reserva->precio_pagado,
                'tipo' => 'reembolso',
                'concepto' => 'Reembolso por cancelación de reserva ID ' . $reservaId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return back()->with('success', 'Reserva cancelada correctamente, se ha reembolsado el importe correspondiente.');
    }

    public function getSaldo(Request $request)
    {
        $usuario = Auth::user();
        $saldo = DB::table('users')->where('id', '=', $usuario->id)->value('saldo_actual');
        $transacciones = DB::table('transacciones')
            ->where('user_id', '=', $usuario->id)
            ->orderByDesc('fecha')
            ->get();
        return view('socio.saldo', compact('saldo', 'transacciones'));
    }

    public function setSaldo(Request $request)
    {
        $usuario = Auth::user();
        $validated = $request->validate([
            'monto' => ['required', 'integer', 'min:1'],
        ], [
            'monto.integer' => 'La cantidad debe ser un numero entero sin decimales.',
        ]);
        $monto = (int) $validated['monto'];

        try {
            $apiKey = config('services.tpvv.key');
            $baseUrl = rtrim(config('services.tpvv.base_url', 'https://tpv-backend-cbbg.onrender.com'), '/');

            if (!$apiKey) {
                return back()->with('error', 'No hay API Key configurada para el TPVV.');
            }

            $transaccionId = DB::table('transacciones')->insertGetId([
                'user_id' => $usuario->id,
                'fecha' => now(),
                'monto' => $monto,
                'tipo' => 'recarga_pendiente',
                'concepto' => 'Recarga de saldo mediante TPVV (pendiente)',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $externalReference = 'SALDO-' . $usuario->id . '-' . $transaccionId;
            $callbackUrl = route('socio.saldo.callback');

            $response = Http::withHeaders([
                'X-API-KEY' => $apiKey,
            ])->post($baseUrl . '/api/v1/payments/init', [
                'amount' => $monto,
                'callbackUrl' => $callbackUrl,
                'externalReference' => $externalReference,
            ]);

            if (!$response->successful()) {
                DB::table('transacciones')
                    ->where('id', $transaccionId)
                    ->update([
                        'tipo' => 'recarga_fallida',
                        'concepto' => 'Recarga fallida mediante TPVV (error init)',
                        'updated_at' => now(),
                    ]);

                return back()->with('error', 'No se pudo iniciar el pago con el TPVV.');
            }

            $payload = $response->json();
            $paymentUrl = $payload['paymentUrl'] ?? null;
            $token = $payload['token'] ?? null;

            if (!$paymentUrl || !$token) {
                DB::table('transacciones')
                    ->where('id', $transaccionId)
                    ->update([
                        'tipo' => 'recarga_fallida',
                        'concepto' => 'Recarga fallida mediante TPVV (respuesta invalida)',
                        'updated_at' => now(),
                    ]);

                return back()->with('error', 'Respuesta invalida del TPVV.');
            }

            DB::table('transacciones')
                ->where('id', $transaccionId)
                ->update([
                    'concepto' => 'Recarga de saldo mediante TPVV (token: ' . $token . ')',
                    'updated_at' => now(),
                ]);

            return redirect()->away($paymentUrl);
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    public function handleSaldoCallback(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect()->route('socio.saldo')->with('error', 'Token de pago no recibido.');
        }

        $apiKey = config('services.tpvv.key');
        $baseUrl = rtrim(config('services.tpvv.base_url', 'https://tpv-backend-cbbg.onrender.com'), '/');

        if (!$apiKey) {
            return redirect()->route('socio.saldo')->with('error', 'No hay API Key configurada para el TPVV.');
        }

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $apiKey,
            ])->get($baseUrl . '/api/v1/payments/verify/' . $token);

            if (!$response->successful()) {
                return redirect()->route('socio.saldo')->with('error', 'No se pudo verificar el pago.');
            }

            $status = $response->json('status');

            $transaccion = DB::table('transacciones')
                ->where('concepto', 'like', '%token: ' . $token . '%')
                ->first();

            if (!$transaccion) {
                return redirect()->route('socio.saldo')->with('error', 'Transaccion no encontrada.');
            }

            if ($status === 'COMPLETED') {
                if ($transaccion->tipo !== 'recarga') {
                    DB::transaction(function () use ($transaccion) {
                        DB::table('users')
                            ->where('id', $transaccion->user_id)
                            ->update(['saldo_actual' => DB::raw('saldo_actual + ' . $transaccion->monto)]);

                        DB::table('transacciones')
                            ->where('id', $transaccion->id)
                            ->update([
                                'tipo' => 'recarga',
                                'concepto' => 'Recarga de saldo mediante TPVV',
                                'updated_at' => now(),
                            ]);
                    });
                }

                return redirect()->route('socio.saldo')->with('success', 'Recarga completada correctamente.');
            }

            DB::table('transacciones')
                ->where('id', $transaccion->id)
                ->update([
                    'tipo' => 'recarga_fallida',
                    'concepto' => 'Recarga fallida mediante TPVV',
                    'updated_at' => now(),
                ]);

            return redirect()->route('socio.saldo')->with('error', 'El pago no se completo.');
        } catch (\Exception $e) {
            return redirect()->route('socio.saldo')->with('error', 'Error al verificar el pago: ' . $e->getMessage());
        }
    }
public function getPerfil(Request $request)
    {
        $usuario = Auth::user();

        $userDB = DB::table('users')
            ->where('id', $usuario->id)
            ->get();

        return view('socio.perfil', compact('usuario'));
    }

    public function updatePerfil(Request $request)
    {
        $usuario = Auth::user();

        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellidos' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $usuario->id],
            'telefono' => ['nullable', 'string', 'max:30'],
            'direccion' => ['nullable', 'string', 'max:255'],
        ]);

        $fields = ['nombre', 'apellidos', 'email', 'telefono', 'direccion'];
        $updates = [];

        foreach ($fields as $field) {
            $value = $validated[$field] ?? null;
            if ($value === '') {
                $value = null;
            }

            if ($usuario->{$field} !== $value) {
                $updates[$field] = $value;
            }
        }

        if (empty($updates)) {
            return back()->with('success', 'No hay cambios para guardar.');
        }

        $updates['updated_at'] = now();

        DB::table('users')
            ->where('id', $usuario->id)
            ->update($updates);

        return back()->with('success', 'Datos actualizados correctamente.');
    }

    public function updatePassword(Request $request)
    {
        $usuario = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        if (!Hash::check($validated['current_password'], $usuario->password)) {
            return back()->withErrors(['current_password' => 'La contrasena actual no es correcta.']);
        }

        DB::table('users')
            ->where('id', $usuario->id)
            ->update([
                'password' => Hash::make($validated['password']),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Contrasena actualizada correctamente.');
    }

    public function getTienda(Request $request)
    {
        $usuario = Auth::user();

        // Si el usuario tiene que renovar, redirigir a pagina de error
        $proximaRenovacion = $usuario->proxima_renovacion
            ? Carbon::parse($usuario->proxima_renovacion)
            : Carbon::parse($usuario->created_at)->addMonth();
        if ($proximaRenovacion && $proximaRenovacion <= now()) {
            return redirect()->route('socio.plan.renovar');
        }


        // API Tienda

        return view('socio.tienda');
    }

    public function getPlan(Request $request)
    {
        $usuario = Auth::user();

        // Si el usuario tiene que renovar, redirigir a pagina de error
        $proximaRenovacion = $usuario->proxima_renovacion
            ? Carbon::parse($usuario->proxima_renovacion)
            : Carbon::parse($usuario->created_at)->addMonth();
        if ($proximaRenovacion && $proximaRenovacion <= now()) {
            return redirect()->route('socio.plan.renovar');
        }

        $planActual = DB::table('planes')->where('id', $usuario->plan_id)->first();

        $planesDisponibles = DB::table('planes')->orderBy('nombre')->get();

        // Obtener las clases disponibles del usuario con el plan actual
        $clasesDisponibles = $planActual->clases_gratis_incluidas - DB::table('reservas')
            ->join('clases', 'reservas.clase_id', '=', 'clases.id')
            ->where('user_id', $usuario->id)
            ->where('uso_clase_gratuita', true)
            ->where('reservas.estado', '!=', 'cancelada')
            ->whereBetween('clases.fecha_inicio', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ])
            ->count();

        return view('socio.plan', compact('planActual', 'planesDisponibles', 'clasesDisponibles'));
    }

    public function setPlan(Request $request, $planId)
    {
        $usuario = Auth::user();

        $planId = (int) $planId;

        if ($planId === (int) $usuario->plan_id) {
            return back()->with('status', 'Ya tienes este plan activo.');
        }

        DB::table('users')
            ->where('id', $usuario->id)
            ->update([
                'proximo_plan_id' => $planId,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Plan actualizado correctamente, se aplicará en la próxima renovación.');
    }

    public function renovarPlan(Request $request)
    {
        $user = Auth::user();

        $proximaRenovacion = $user->proxima_renovacion
            ? Carbon::parse($user->proxima_renovacion)
            : Carbon::parse($user->created_at)->addMonth();
        if ($proximaRenovacion && $proximaRenovacion > now()) {
            return redirect()->route('socio.actividades');
        }

        return view('socio.renovacion-bloqueada', );
    }

    public function estadoPendiente(Request $request)
    {
        return view('socio.estado-pendiente');
    }

    public function estadoBloqueado(Request $request)
    {
        return view('socio.estado-bloqueado');
    }
}
