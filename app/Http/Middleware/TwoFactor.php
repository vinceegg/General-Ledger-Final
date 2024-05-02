<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactor
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (auth()->check() && $user->code)
        {
            if(!$request->is('verify*'))
            {
                return redirect()->route('verify.index');
            }
        }
        return $next($request);
    }
}
