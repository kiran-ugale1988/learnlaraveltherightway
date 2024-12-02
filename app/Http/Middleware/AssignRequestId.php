<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AssignRequestId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Logic
        $requestId = (string) Str::uuid();
        
        $request->headers->set('X-Request-Id', $requestId);

        $response = $next($request);

        //Logic
        $response->headers->set('X-Request-Id', $requestId);

        return $response;
    }
}