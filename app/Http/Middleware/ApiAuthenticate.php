<?php

namespace ExtrasMe\Http\Middleware;

use Closure, Session, ExtrasMeApi;

class ApiAuthenticate
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
      $token = Session::get('api_token');
      if (!is_null($token) && ExtrasMeApi::authVerify($token))
      {
         return $next($request);
      }

      return redirect()->route('index');
    }
}
