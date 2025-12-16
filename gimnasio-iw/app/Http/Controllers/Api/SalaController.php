<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use App\Models\Clase; // Importante
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalaController extends Controller
{
    public function aforo($id, Request $request)
    {
        // 1. Buscar la sala
        $sala = Sala::find($id);
        if (!$sala) {
            return response()->json(['error' => 'Sala not found'], 404);
        }

        // 2. Determinar la hora de consulta (ahora o la que pidan)
        $fechaHora = $request->has('fecha_hora') 
            ? Carbon::parse($request->fecha_hora) 
            : Carbon::now();

        // 3. Buscar si hay una CLASE en esa sala a esa hora
        // Que empiece antes de la hora y termine después
        $claseActual = Clase::where('sala_id', $id)
            ->where('fecha_inicio', '<=', $fechaHora)
            ->where('fecha_fin', '>=', $fechaHora)
            ->withCount('reservas') // Cuenta mágica de Laravel
            ->first();

        // 4. Calcular datos
        $ocupacion = $claseActual ? $claseActual->reservas_count : 0;
        $porcentaje = $sala->aforo_maximo > 0 
            ? round(($ocupacion / $sala->aforo_maximo) * 100) 
            : 0;

        // 5. Devolver respuesta
        return response()->json([
            'sala_id' => $sala->id,
            'nombre' => $sala->nombre,
            'consulta_para' => $fechaHora->toDateTimeString(),
            'capacidad_maxima' => $sala->aforo_maximo,
            'ocupacion_estimada' => $ocupacion,
            'porcentaje_ocupacion' => $porcentaje . '%'
        ]);
    }
}