<?php

namespace App\Http\Middleware;

use Closure;

use \App\Perfil;

class PerfilMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $id = auth()->user()->id;

        $perfil = Perfil::where('us_id', $id)->where('activo', '>', '0')->first();

        if ($perfil) {
            return redirect('/perfil')->with('erroresc', '¡Ya haz creado un perfil!');
        }

        return $next($request);
    }
}
