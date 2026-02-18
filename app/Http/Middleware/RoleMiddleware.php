<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if ($user === null) {
            abort(Response::HTTP_FORBIDDEN, 'Silakan login terlebih dahulu.');
        }

        if ($roles !== [] && in_array($user->role, $roles, true) === false) {
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki hak akses.');
        }

        return $next($request);
    }
}
