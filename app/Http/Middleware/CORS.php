<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CORS
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
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        //$request->header('Access-Control-Allow-Origin', '*');
        //$request->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH,DELETE, OPTIONS');
        //->header("Allow: GET, POST, OPTIONS, PUT, DELETE")
          //  ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization"); 
        //$request->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        //return $next($request);
        
    }
}
