<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;

class StatusFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->has('status') && request()->get('status') != null) {
            return $next($request)->where('is_finished', (bool)request()->get('status'));
        }
        return $next($request);
    }
}