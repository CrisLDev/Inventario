<?php

namespace App\Http\Middleware;

use \App\Perfil;

use Closure;

class NoPerfilMiddleware
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

        $perfil = Perfil::where('us_id', $id)->first();

        if (!$perfil) {
            return redirect('/perfil')->with('erroresc', '¡Aún no haz creado un perfil!');
        }

        return $next($request);
    }
}
