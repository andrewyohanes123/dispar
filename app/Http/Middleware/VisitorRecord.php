<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \App\Visitor;

class VisitorRecord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return $request->all();
        return $next($request);
    }
}
