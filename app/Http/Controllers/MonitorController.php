<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Clase; // Asegúrate de tener el modelo Clase, si no usa DB
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MonitorController extends Controller
{
    // 1. VISTA CALENDARIO (Dashboard)
    public function dashboard()
    {
        $monitorId = Auth::id();
        $inicioSemana = Carbon::now()->startOfWeek();
        $finSemana = Carbon::now()->endOfWeek();

        // Obtenemos las clases de ESTA semana
        $clases = DB::table('clases')
            ->join('actividades', 'clases.actividad_id', '=', 'actividades.id')
            ->join('salas', 'clases.sala_id', '=', 'salas.id')
            ->select('clases.*', 'actividades.nombre as actividad_nombre', 'salas.nombre as sala_nombre')
            ->where('monitor_id', $monitorId)
            ->whereBetween('fecha_inicio', [$inicioSemana, $finSemana])
            ->get();

        // Estructura para el calendario (Lunes a Domingo, 07:00 a 22:00)
        $calendario = [];
        foreach ($clases as $clase) {
            $fecha = Carbon::parse($clase->fecha_inicio);
            $diaSemana = $fecha->dayOfWeek; // 1 (Lunes) a 7 (Domingo)
            $hora = $fecha->hour;
            
            // Guardamos la clase en la posición exacta
            $calendario[$hora][$diaSemana] = $clase;
        }

        // Estadísticas simples para el footer del mockup
        $clasesSemanaCount = $clases->count();
        
        return view('monitor.dashboard', compact('calendario', 'clasesSemanaCount'));
    }

    // 2. VISTA MIS ACTIVIDADES (Lista futura + Detalles)
    public function misActividades(Request $request)
    {
        $monitorId = Auth::id();
        $now = Carbon::now();

        // Clases FUTURAS (ordenadas por fecha más próxima)
        $clases = DB::table('clases')
            ->join('actividades', 'clases.actividad_id', '=', 'actividades.id')
            ->join('salas', 'clases.sala_id', '=', 'salas.id')
            ->select('clases.*', 'actividades.nombre as actividad_nombre', 'salas.nombre as sala_nombre')
            ->where('monitor_id', $monitorId)
            ->where('fecha_inicio', '>=', $now)
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        // Contar inscritos para cada clase (Barra de progreso)
        foreach ($clases as $clase) {
            $clase->inscritos = DB::table('reservas')->where('clase_id', $clase->id)->count();
            $clase->porcentaje = ($clase->inscritos / $clase->plazas_totales) * 100;
        }

        // Lógica para el panel derecho (Detalles de una clase seleccionada)
        $claseSeleccionada = null;
        $participantes = [];

        if ($request->has('clase_id')) {
            $claseSeleccionada = $clases->firstWhere('id', $request->get('clase_id'));
            
            if ($claseSeleccionada) {
                $participantes = DB::table('reservas')
                    ->join('users', 'reservas.user_id', '=', 'users.id')
                    ->where('clase_id', $claseSeleccionada->id)
                    ->select('users.nombre', 'users.email')
                    ->get();
            }
        }

        return view('monitor.actividades', compact('clases', 'claseSeleccionada', 'participantes'));
    }

    // 3. VISTA HISTÓRICO (Pasado)
    public function historico()
    {
        $monitorId = Auth::id();
        $now = Carbon::now();

        $clases = DB::table('clases')
            ->join('actividades', 'clases.actividad_id', '=', 'actividades.id')
            ->join('salas', 'clases.sala_id', '=', 'salas.id')
            ->select('clases.*', 'actividades.nombre as actividad_nombre', 'salas.nombre as sala_nombre')
            ->where('monitor_id', $monitorId)
            ->where('fecha_inicio', '<', $now) // <--- FECHA PASADA
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        return view('monitor.historico', compact('clases'));
    }
}