<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EstadoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$estados): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $estado = (string) ($user->estado ?? '');

        if (empty($estados) || in_array($estado, $estados, true)) {
            return $next($request);
        }

        if ($estado === 'bloqueado') {
            return redirect()->route('socio.estado.bloqueado');
        }

        if ($estado === 'pendiente') {
            return redirect()->route('socio.estado.pendiente');
        }

        abort(403);
    }
}
