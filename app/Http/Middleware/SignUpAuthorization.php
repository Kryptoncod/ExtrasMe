<?php

namespace App\Http\Middleware;

use Closure;

class SignUpAuthorization
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
        if(session()->has('signUpAuthorization'))
        {
            $authorization = $request->session()->get('signUpAuthorization');

            if($authorization == 'extrasmeEHL2016')
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('index');
            }
        }

        return redirect()->route('index');
    }
}
