<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado usando Passport
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Acceso denegado. Token no válido o ausente'
            ], 401);
        }

        return $next($request);
    }
}
