<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Accès non autorisé. Seuls les administrateurs peuvent accéder à cette ressource.'], 403);
            }

            return redirect()->route('home')->with('error', 'Accès non autorisé. Seuls les administrateurs peuvent accéder à cette section.');
        }

        return $next($request);
    }
}
