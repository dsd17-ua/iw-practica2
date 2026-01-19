<?php

/*
 * ============================================================================
 * [POR CONFIRMAR] - WebmasterController.php
 * ============================================================================
 * Este archivo debe ser revisado antes de implementarse en el proyecto.
 * Contiene la lógica del panel de administración del webmaster.
 * ============================================================================
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Actividad;
use App\Models\Clase;
use App\Models\Sala;
use App\Models\Plan;
use Carbon\Carbon;

class WebmasterController extends Controller
{
    // =================================================================
    // DASHBOARD
    // =================================================================
    
    public function dashboard()
    {
        // Estadísticas generales
        $solicitudesPendientes = User::where('rol', 'socio')
            ->where('estado', 'pendiente')
            ->count();
        
        $sociosActivos = User::where('rol', 'socio')
            ->where('estado', 'activo')
            ->count();
        
        $sociosBloqueados = User::where('rol', 'socio')
            ->where('estado', 'bloqueado')
            ->count();
        
        // Próximas clases (siguientes 10)
        $proximasClases = Clase::with(['actividad', 'sala', 'monitor'])
            ->where('fecha_inicio', '>=', now())
            ->where('estado', 'programada')
            ->orderBy('fecha_inicio', 'asc')
            ->limit(10)
            ->get();
        
        // Clases de hoy
        $clasesHoy = Clase::whereDate('fecha_inicio', today())
            ->where('estado', 'programada')
            ->count();
        
        return view('webmaster.dashboard', compact(
            'solicitudesPendientes',
            'sociosActivos',
            'sociosBloqueados',
            'proximasClases',
            'clasesHoy'
        ));
    }

    // =================================================================
    // GESTIÓN DE SOLICITUDES
    // =================================================================
    
    public function listarSolicitudes()
    {
        $solicitudes = User::with('plan')
            ->where('rol', 'socio')
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('webmaster.solicitudes', compact('solicitudes'));
    }
    
    public function aprobarSolicitud($userId)
    {
        DB::beginTransaction();
        
        try {
            $usuario = User::findOrFail($userId);
            
            // Verificar que está pendiente
            if ($usuario->estado !== 'pendiente') {
                return back()->with('error', 'Esta solicitud ya fue procesada.');
            }
            
            // Generar número de socio único
            $numeroSocio = $this->generarNumeroSocio();
            
            // Actualizar usuario
            $usuario->update([
                'estado' => 'activo',
                'numero_socio' => $numeroSocio,
                'proxima_renovacion' => Carbon::now()->addMonth(),
            ]);
            
            // Enviar email de bienvenida
            $this->enviarEmailBienvenida($usuario);
            
            DB::commit();
            
            return back()->with('success', "Solicitud aprobada. Nuevo socio: {$numeroSocio}");
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al aprobar solicitud: ' . $e->getMessage());
        }
    }
    
    public function rechazarSolicitud($userId)
    {
        DB::beginTransaction();
        
        try {
            $usuario = User::findOrFail($userId);
            
            // Verificar que está pendiente
            if ($usuario->estado !== 'pendiente') {
                return back()->with('error', 'Esta solicitud ya fue procesada.');
            }
            
            // Cambiar estado a bloqueado
            $usuario->update([
                'estado' => 'bloqueado',
            ]);
            
            // Enviar email de rechazo
            $this->enviarEmailRechazo($usuario);
            
            DB::commit();
            
            return back()->with('success', 'Solicitud rechazada correctamente.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al rechazar solicitud: ' . $e->getMessage());
        }
    }
    
    private function generarNumeroSocio()
    {
        $ultimoNumero = User::where('numero_socio', 'like', 'SOC-%')
            ->orderBy('numero_socio', 'desc')
            ->value('numero_socio');
        
        if ($ultimoNumero) {
            $numero = (int) str_replace('SOC-', '', $ultimoNumero);
            return 'SOC-' . str_pad($numero + 1, 6, '0', STR_PAD_LEFT);
        }
        
        return 'SOC-000001';
    }
    
    private function enviarEmailBienvenida($usuario)
    {
        $mensaje = "Hola {$usuario->nombre},\n\n"
            . "¡Bienvenido a FitZone Gym!\n\n"
            . "Tu solicitud ha sido aprobada. Estos son tus datos de acceso:\n\n"
            . "Número de socio: {$usuario->numero_socio}\n"
            . "Email: {$usuario->email}\n"
            . "Contraseña: 1234 (te recomendamos cambiarla en tu perfil)\n\n"
            . "Puedes acceder al área privada en nuestra web.\n\n"
            . "¡Disfruta de todas nuestras instalaciones!";
        
        Mail::raw($mensaje, function ($message) use ($usuario) {
            $message->to($usuario->email)
                ->subject('¡Bienvenido a FitZone Gym!');
        });
    }
    
    private function enviarEmailRechazo($usuario)
    {
        $mensaje = "Hola {$usuario->nombre},\n\n"
            . "Lamentamos informarte que tu solicitud para unirte a FitZone Gym "
            . "no ha sido aprobada en este momento.\n\n"
            . "Si tienes alguna pregunta, no dudes en contactarnos.\n\n"
            . "Saludos,\nEquipo FitZone Gym";
        
        Mail::raw($mensaje, function ($message) use ($usuario) {
            $message->to($usuario->email)
                ->subject('Estado de tu solicitud - FitZone Gym');
        });
    }

    // =================================================================
    // GESTIÓN DE SOCIOS
    // =================================================================
    
    public function listarSocios(Request $request)
    {
        $query = User::with('plan')
            ->where('rol', 'socio');
        
        // Filtro por estado
        if ($request->filled('estado')){
            $query->where('estado', $request->estado);
        }
        
        // Filtro por búsqueda
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('apellidos', 'like', "%{$buscar}%")
                  ->orWhere('email', 'like', "%{$buscar}%")
                  ->orWhere('numero_socio', 'like', "%{$buscar}%");
            });
        }
        
        $socios = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('webmaster.socios', compact('socios'));
    }
    
    public function cambiarEstadoSocio(Request $request, $userId)
    {
        try {
            $usuario = User::findOrFail($userId);
            
            $nuevoEstado = $request->input('nuevo_estado');
            
            if (!in_array($nuevoEstado, ['activo', 'bloqueado'])) {
                return back()->with('error', 'Estado inválido.');
            }
            
            $usuario->update([
                'estado' => $nuevoEstado,
            ]);
            
            $accion = $nuevoEstado === 'activo' ? 'activado' : 'bloqueado';
            
            return back()->with('success', "Socio {$accion} correctamente.");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cambiar estado: ' . $e->getMessage());
        }
    }

    // =================================================================
    // GESTIÓN DE ACTIVIDADES
    // =================================================================
    
    public function listarActividades()
    {
        $actividades = Actividad::orderBy('nombre', 'asc')->paginate(20);
        
        return view('webmaster.actividades.index', compact('actividades'));
    }
    
    public function crearActividad()
    {
        return view('webmaster.actividades.crear');
    }
    
    public function guardarActividad(Request $request)
    {
        $validado = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen_url' => 'nullable|url|max:500',
        ]);
        
        try {
            Actividad::create($validado);
            
            return redirect()->route('webmaster.actividades')
                ->with('success', 'Actividad creada correctamente.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear actividad: ' . $e->getMessage());
        }
    }
    
    public function editarActividad($id)
    {
        $actividad = Actividad::findOrFail($id);
        
        return view('webmaster.actividades.editar', compact('actividad'));
    }
    
    public function actualizarActividad(Request $request, $id)
    {
        $validado = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen_url' => 'nullable|url|max:500',
        ]);
        
        try {
            $actividad = Actividad::findOrFail($id);
            $actividad->update($validado);
            
            return redirect()->route('webmaster.actividades')
                ->with('success', 'Actividad actualizada correctamente.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar actividad: ' . $e->getMessage());
        }
    }
    
    public function eliminarActividad($id)
    {
        try {
            $actividad = Actividad::findOrFail($id);
            
            // Verificar si tiene clases asociadas
            $tieneClases = Clase::where('actividad_id', $id)->exists();
            
            if ($tieneClases) {
                return back()->with('error', 'No se puede eliminar la actividad porque tiene clases programadas.');
            }
            
            $actividad->delete();
            
            return back()->with('success', 'Actividad eliminada correctamente.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar actividad: ' . $e->getMessage());
        }
    }

    // =================================================================
    // GESTIÓN DE CLASES
    // =================================================================
    
    public function listarClases(Request $request)
    {
        $query = Clase::with(['actividad', 'sala', 'monitor']);
        
        // Filtros
        if ($request->filled('actividad_id')) {
            $query->where('actividad_id', $request->actividad_id);
        }
        
        if ($request->filled('monitor_id')) {
            $query->where('monitor_id', $request->monitor_id);
        }
        
        if ($request->filled('fecha') ) {
            $query->whereDate('fecha_inicio', $request->fecha);
        }
        
        $clases = $query->orderBy('fecha_inicio', 'desc')->paginate(20);
        
        // Datos para filtros
        $actividades = Actividad::orderBy('nombre')->get();
        $monitores = User::where('rol', 'monitor')->orderBy('nombre')->get();
        
        return view('webmaster.clases.index', compact('clases', 'actividades', 'monitores'));
    }
    
    public function crearClase()
    {
        $actividades = Actividad::orderBy('nombre')->get();
        $salas = Sala::orderBy('nombre')->get();
        $monitores = User::where('rol', 'monitor')->orderBy('nombre')->get();
        
        return view('webmaster.clases.crear', compact('actividades', 'salas', 'monitores'));
    }
    
    public function guardarClase(Request $request)
    {
        $validado = $request->validate([
            'actividad_id' => 'required|exists:actividades,id',
            'sala_id' => 'required|exists:salas,id',
            'monitor_id' => 'required|exists:users,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'coste_extra' => 'required|numeric|min:0',
            'plazas_totales' => 'required|integer|min:1',
            'tipo_programacion' => 'required|in:puntual,periodica',
            'frecuencia' => 'required_if:tipo_programacion,periodica|in:diaria,semanal',
            'repeticiones' => 'required_if:tipo_programacion,periodica|integer|min:1|max:52',
        ]);
        
        DB::beginTransaction();
        
        try {
            if ($validado['tipo_programacion'] === 'puntual') {
                // Crear una sola clase
                Clase::create([
                    'actividad_id' => $validado['actividad_id'],
                    'sala_id' => $validado['sala_id'],
                    'monitor_id' => $validado['monitor_id'],
                    'fecha_inicio' => $validado['fecha_inicio'],
                    'fecha_fin' => $validado['fecha_fin'],
                    'coste_extra' => $validado['coste_extra'],
                    'plazas_totales' => $validado['plazas_totales'],
                    'asistencia_actual' => 0,
                    'estado' => 'programada',
                ]);
            } else {
                // Crear clases periódicas
                $this->crearClasesPeriodicas($validado);
            }
            
            DB::commit();
            
            return redirect()->route('webmaster.clases')
                ->with('success', 'Clase(s) creada(s) correctamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear clase: ' . $e->getMessage());
        }
    }
    
    private function crearClasesPeriodicas($datos)
    {
        $fechaInicio = Carbon::parse($datos['fecha_inicio']);
        $fechaFin = Carbon::parse($datos['fecha_fin']);
        $duracion = $fechaInicio->diffInMinutes($fechaFin);
        
        $incrementoDias = $datos['frecuencia'] === 'diaria' ? 1 : 7;
        
        for ($i = 0; $i < $datos['repeticiones']; $i++) {
            $nuevaFechaInicio = $fechaInicio->copy()->addDays($incrementoDias * $i);
            $nuevaFechaFin = $nuevaFechaInicio->copy()->addMinutes($duracion);
            
            Clase::create([
                'actividad_id' => $datos['actividad_id'],
                'sala_id' => $datos['sala_id'],
                'monitor_id' => $datos['monitor_id'],
                'fecha_inicio' => $nuevaFechaInicio,
                'fecha_fin' => $nuevaFechaFin,
                'coste_extra' => $datos['coste_extra'],
                'plazas_totales' => $datos['plazas_totales'],
                'asistencia_actual' => 0,
                'estado' => 'programada',
            ]);
        }
    }
    
    public function editarClase($id)
    {
        $clase = Clase::with(['actividad', 'sala', 'monitor'])->findOrFail($id);
        $actividades = Actividad::orderBy('nombre')->get();
        $salas = Sala::orderBy('nombre')->get();
        $monitores = User::where('rol', 'monitor')->orderBy('nombre')->get();
        
        return view('webmaster.clases.editar', compact('clase', 'actividades', 'salas', 'monitores'));
    }
    
    public function actualizarClase(Request $request, $id)
    {
        $validado = $request->validate([
            'actividad_id' => 'required|exists:actividades,id',
            'sala_id' => 'required|exists:salas,id',
            'monitor_id' => 'required|exists:users,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'coste_extra' => 'required|numeric|min:0',
            'plazas_totales' => 'required|integer|min:1',
            'estado' => 'required|in:programada,finalizada,cancelada',
        ]);
        
        try {
            $clase = Clase::findOrFail($id);
            $clase->update($validado);
            
            return redirect()->route('webmaster.clases')
                ->with('success', 'Clase actualizada correctamente.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar clase: ' . $e->getMessage());
        }
    }
    
    public function eliminarClase($id)
    {
        try {
            $clase = Clase::findOrFail($id);
            
            // Verificar si tiene reservas
            if ($clase->asistencia_actual > 0) {
                return back()->with('error', 'No se puede eliminar la clase porque ya tiene reservas.');
            }
            
            $clase->delete();
            
            return back()->with('success', 'Clase eliminada correctamente.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar clase: ' . $e->getMessage());
        }
    }

    // =================================================================
    // INFORMES Y ESTADÍSTICAS
    // =================================================================
    
    public function informeUsoInstalaciones()
    {
        // Clases por sala
        $clasesPorSala = DB::table('clases')
            ->join('salas', 'clases.sala_id', '=', 'salas.id')
            ->select('salas.nombre', DB::raw('COUNT(*) as total_clases'))
            ->groupBy('salas.id', 'salas.nombre')
            ->orderBy('total_clases', 'desc')
            ->get();
        
        // Tasa de ocupación promedio por sala
        $ocupacionPorSala = DB::table('clases')
            ->join('salas', 'clases.sala_id', '=', 'salas.id')
            ->select(
                'salas.nombre',
                DB::raw('AVG((clases.asistencia_actual * 100.0) / clases.plazas_totales) as ocupacion_promedio')
            )
            ->groupBy('salas.id', 'salas.nombre')
            ->orderBy('ocupacion_promedio', 'desc')
            ->get();
        
        // Informe de actividades
        $actividadesPopulares = DB::table('reservas')
            ->join('clases', 'reservas.clase_id', '=', 'clases.id')
            ->join('actividades', 'clases.actividad_id', '=', 'actividades.id')
            ->select('actividades.nombre', DB::raw('COUNT(*) as total_reservas'))
            ->groupBy('actividades.id', 'actividades.nombre')
            ->orderBy('total_reservas', 'desc')
            ->limit(10)
            ->get();

        $sociosActivos = DB::table('reservas')
            ->join('users', 'reservas.user_id', '=', 'users.id')
            ->select('users.nombre', 'users.apellidos', 'users.numero_socio', DB::raw('COUNT(*) as total_reservas'))
            ->groupBy('users.id', 'users.nombre', 'users.apellidos', 'users.numero_socio')
            ->orderBy('total_reservas', 'desc')
            ->limit(10)
            ->get();

        $ingresosPorActividad = DB::table('clases')
            ->join('actividades', 'clases.actividad_id', '=', 'actividades.id')
            ->select('actividades.nombre', DB::raw('SUM(clases.coste_extra) as total_ingresos'))
            ->where('clases.coste_extra', '>', 0)
            ->groupBy('actividades.id', 'actividades.nombre')
            ->orderBy('total_ingresos', 'desc')
            ->get();

        return view('webmaster.informes.instalaciones', compact(
            'clasesPorSala', 
            'ocupacionPorSala',
            'actividadesPopulares',
            'sociosActivos',
            'ingresosPorActividad'
        ));
    }
}
