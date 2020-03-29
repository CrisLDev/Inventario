<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        $rol = $roles = auth()->user()->roles;
        if($rol[0]->id != '1'){
            return abort(404);
        }
        return $next($request);
    }
}
