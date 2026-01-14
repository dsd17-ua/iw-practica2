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
    public function dashboard(Request $request)
    {
        $monitorId = Auth::id();
        
        // 1. Gestión de la semana (Offset)
        // Si offset es 0, es la semana actual. Si es 1, es la siguiente, etc.
        $offset = (int) $request->get('semana', 0); 
        
        $inicioSemana = Carbon::now()->startOfWeek()->addWeeks($offset);
        $finSemana = $inicioSemana->copy()->endOfWeek();

        // 2. Obtener Clases
        $clases = DB::table('clases')
            ->join('actividades', 'clases.actividad_id', '=', 'actividades.id')
            ->join('salas', 'clases.sala_id', '=', 'salas.id')
            ->select('clases.*', 'actividades.nombre as actividad_nombre', 'salas.nombre as sala_nombre')
            ->where('monitor_id', $monitorId)
            ->whereBetween('fecha_inicio', [$inicioSemana, $finSemana])
            ->get();

        // 3. Estructura Calendario y Datos para la Cabecera
        $calendario = [];
        $diasSemana = []; // Para poner "Lunes 12", "Martes 13"...

        // Generamos los encabezados de los días
        $tempDate = $inicioSemana->copy();
        for ($i = 1; $i <= 7; $i++) {
            $diasSemana[$i] = [
                'nombre' => ucfirst($tempDate->translatedFormat('l')), // Lunes
                'fecha' => $tempDate->format('d'), // 12
                'es_hoy' => $tempDate->isToday()
            ];
            $tempDate->addDay();
        }

        // Rellenamos la matriz del calendario
        foreach ($clases as $clase) {
            $fecha = Carbon::parse($clase->fecha_inicio);
            $diaSemana = $fecha->dayOfWeekIso; // 1 (Lunes) a 7 (Domingo)
            $hora = $fecha->hour;
            
            // Calculamos inscritos para mostrar en el detalle
            $clase->inscritos_count = DB::table('reservas')
                ->where('clase_id', $clase->id)
                ->count();

            $calendario[$hora][$diaSemana] = $clase;
        }

        $clasesSemanaCount = $clases->count();
        
        return view('monitor.dashboard', compact('calendario', 'clasesSemanaCount', 'inicioSemana', 'finSemana', 'offset', 'diasSemana'));
    }
    // 2. VISTA MIS ACTIVIDADES (Lista futura + Detalles)
    public function misActividades(Request $request)
    {
        $monitorId = Auth::id();
        
        // CAMBIO CLAVE: En vez de 'now()', usamos 'startOfDay()'
        // Esto coge fecha y hora 00:00:00 de HOY.
        $desdeHoy = Carbon::now()->startOfDay();

        // Clases (ordenadas por fecha más próxima)
        $clases = DB::table('clases')
            ->join('actividades', 'clases.actividad_id', '=', 'actividades.id')
            ->join('salas', 'clases.sala_id', '=', 'salas.id')
            ->select('clases.*', 'actividades.nombre as actividad_nombre', 'salas.nombre as sala_nombre')
            ->where('monitor_id', $monitorId)
            ->where('fecha_inicio', '>=', $desdeHoy) // <--- Ahora busca desde las 00:00 de hoy
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        // ... (El resto del código del método sigue igual: contar inscritos, etc.)
        foreach ($clases as $clase) {
            $clase->inscritos = DB::table('reservas')->where('clase_id', $clase->id)->count();
            $clase->porcentaje = $clase->plazas_totales > 0 ? ($clase->inscritos / $clase->plazas_totales) * 100 : 0;
        }
        
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
            ->where('fecha_inicio', '<', $now)
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        // NUEVO: Buscamos los participantes para cada clase del historial
        foreach ($clases as $clase) {
            $clase->participantes = DB::table('reservas')
                ->join('users', 'reservas.user_id', '=', 'users.id')
                ->where('clase_id', $clase->id)
                ->select('users.nombre', 'users.email')
                ->get();
        }

        return view('monitor.historico', compact('clases'));
    }
}