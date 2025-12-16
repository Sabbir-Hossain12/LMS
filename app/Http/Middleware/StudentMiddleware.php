<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() ||  !auth()->user()->hasRole('student')) {
            
            return redirect()->route('student.phone-page');
        }
        return $next($request);
    }
}