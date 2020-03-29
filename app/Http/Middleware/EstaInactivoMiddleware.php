<?php

namespace App\Http\Middleware;

use Closure;

use \App\User;

class EstaInactivoMiddleware
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

        $user = User::where('id',$id)->where( 'activo', '=', '0' )->first();

        if ($user) {
            auth()->logout();
            return abort(403, 'Tu usuario ha sido eliminado.');
        }

        return $next($request);
    }
}
