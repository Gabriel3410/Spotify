<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Permite se o usuário for manager ou admin (que herda as permissões de manager)
        if (!$user || (!$user->is_manager && !$user->is_admin)) {
            abort(403, 'Acesso negado');
        }
        return $next($request);
    }
}
