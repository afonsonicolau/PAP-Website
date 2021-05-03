<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->role_id == 2)
        {
            request()->session()->get('url.intended');

            return $next($request);
        }
        
        abort(403, 'Ação Não-Autorizada.');
    }
}
