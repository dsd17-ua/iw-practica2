<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        // Definimos la clave válida (en un proyecto real iría en el .env)
        $validKey = 'gym_dev_key_2025';

        // Obtenemos la clave de la cabecera
        $apiKey = $request->header('X-API-KEY');

        if ($apiKey !== $validKey) {
            return response()->json(['error' => 'Unauthorized. API Key invalid or missing.'], 401);
        }

        return $next($request);
    }
}