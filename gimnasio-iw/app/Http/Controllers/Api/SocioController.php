<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SocioController extends Controller
{
    public function validar(Request $request)
    {
        // 1. Validar que nos envían el email o el dni
        if (!$request->has('email') && !$request->has('dni')) {
            return response()->json(['error' => 'Bad Request. Email or DNI required.'], 400);
        }

        // 2. Buscar el usuario
        $query = User::with('plan'); // Cargamos el plan para usar su nombre luego

        if ($request->has('email')) {
            $query->where('email', $request->email);
        } else {
            $query->where('dni', $request->dni);
        }

        $user = $query->first();

        // 3. Si no existe -> 404
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // 4. Devolver la respuesta (200 OK)
        return response()->json([
            'es_socio' => ($user->rol === 'socio'), // Devuelve true si es socio
            'estado' => ucfirst($user->estado), // "activo" -> "Activo"
            'plan_actual' => $user->plan ? $user->plan->nombre : 'Sin Plan',
            'antiguedad' => $user->created_at->format('Y-m-d'),
        ], 200);
    }
}