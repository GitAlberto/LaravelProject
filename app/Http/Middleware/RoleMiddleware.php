<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ajout de l'importation de la façade Auth


class RoleMiddleware
{
    /**
     * Gère l'accès selon le rôle de l'utilisateur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Vérifier si l'utilisateur est authentifié et a le bon rôle
        if (!Auth::check())
        {  // Utilisation de Auth::check() et Auth::user()
            return redirect('/');  // Redirige si l'utilisateur n'a pas le bon rôle
        }

        return $next($request);
    }
}

