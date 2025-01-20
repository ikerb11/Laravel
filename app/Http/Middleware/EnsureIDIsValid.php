<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIDIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->has('id')) {
            $id = $request->get('id');
            
            if (!is_int($id))return redirect('/welcome');
            if ($id<0)return redirect('/welcome');
        }
        return $next($request);
    }
}
