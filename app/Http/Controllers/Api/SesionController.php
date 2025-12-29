<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clase;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function index(Request $request)
    {
        // Iniciamos la consulta cargando las relaciones para optimizar
        $query = Clase::with(['actividad', 'sala', 'monitor']);

        // Filtro 1: Por fecha (si viene en la URL ?fecha=2025-10-12)
        if ($request->has('fecha')) {
            $query->whereDate('fecha_inicio', $request->fecha);
        }

        // Filtro 2: Por tipo de actividad (si viene ?actividad_id=X)
        if ($request->has('actividad_id')) {
            $query->where('actividad_id', $request->actividad_id);
        }

        $clases = $query->get();

        // Formateamos la respuesta para que coincida EXACTO con tu documentación
        $datos = $clases->map(function ($clase) {
            return [
                'id' => $clase->id,
                'actividad' => $clase->actividad->nombre,
                'sala' => $clase->sala->nombre,
                'monitor' => $clase->monitor->nombre . ' ' . $clase->monitor->apellidos,
                'horario' => [
                    'inicio' => $clase->fecha_inicio,
                    'fin' => $clase->fecha_fin,
                ],
                'plazas' => [
                    'totales' => $clase->plazas_totales,
                    // Aquí podríamos calcular las disponibles restando reservas
                    'disponibles' => $clase->plazas_totales 
                ],
                'coste_extra' => $clase->coste_extra,
            ];
        });

        return response()->json($datos, 200);
    }
}