<?php

namespace App\Http\Middleware;

use Closure;

class Credentials
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
        if(Auth::guard($guard)->check())
        {
            if(Auth::user()->type != 1)
            {
                return redirect()->back();
            }
            else
            {
                if(session()->has('credentialsConfirm'))
                {
                    return $next($request);
                }
                else
                {
                    return redirect()->route('credits', Auth::user()->id);
                }
            }
        }

        return redirect()->back();
    }
}
