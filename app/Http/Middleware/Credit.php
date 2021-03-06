<?php

namespace App\Http\Middleware;

use App\Models\User;

use Closure;
use Illuminate\Support\Facades\Auth;

class Credit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check())
        {
            if(Auth::user()->type != 1)
            {
                return redirect()->back();
            }
            else
            {
                if(session()->has('what_payment'))
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
