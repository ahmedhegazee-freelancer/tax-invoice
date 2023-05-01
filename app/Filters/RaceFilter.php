<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;

class RaceFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->has('race') && request()->get('race') != null) {
            return $next($request)->where('race_id', (int) request()->get('race'));
        }
        return $next($request);
    }
}