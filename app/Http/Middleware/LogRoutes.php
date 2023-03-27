<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRoutes
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
        $response = $next($request);

        if (app()->environment('local')) {

            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all()
            ];
            
            if(str_contains($request->getUri() , '/api/')){
                $log['RESPONSE'] = $response->getContent();
            }

            Log::channel('daily')->info(json_encode($log));
        }

        return $response;
    }
}