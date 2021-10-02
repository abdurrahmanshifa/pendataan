<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
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
        if(Auth::user()->group != 1){
            //return redirect()->to('logout');
            return abort(403, 'User Tidak Diizinkan Untuk Akses Ini!');
        }
        return $next($request);
    }
}
