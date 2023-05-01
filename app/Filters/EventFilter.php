<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;

class EventFilter
{
    public function handle($request, Closure $next)
    {

        if (request()->has('event') && request()->get('event') != null) {
            return $next($request)->where('event_id', (int)request()->get('event'));
        }
        return $next($request);
    }
}