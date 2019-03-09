<?php

namespace App\Http\Middleware;

use Closure;

class Cros
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
        header("Access-Control-Allow-Origin: *");
      //  header('Access-Control-Expose-Headers', 'Authorization, authenticated');
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: X-Requested-With,Content-Type,Origin,Authorization,Origin,Cookie,X-CSRF-TOKEN,Accept,X-XSRF-TOKE,_token");

        $response = $next($request);
        return $response;
    }
}
