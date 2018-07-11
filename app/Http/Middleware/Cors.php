<?php

namespace App\Http\Middleware;
use Closure;

class Cors {

    public function handle($request, Closure $next) {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Headers', 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization, X-XSRF-TOKEN')
            ->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}
