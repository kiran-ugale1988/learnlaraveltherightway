<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = ['id'=>1, 'name'=> 'Gio', 'role'=>''];
        //=>you will see 404 error if your run route:http://localhost:8081/administration
        $user = ['id'=>1, 'name'=> 'Gio', 'role'=>'admin'];
        //=>you will see Secret Admin Page if your run route:http://localhost:8081/administration
        if($user['role'] == 'admin'){
            return $next($request);
        }

        //return response(404);
        abort(404);
        
    }
}
