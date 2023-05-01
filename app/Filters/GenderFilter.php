<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;

class GenderFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->has('gender') && request()->get('gender') != null) {
            return $next($request)->where('gender_id', (int)request()->get('gender'));
        }
        return $next($request);
    }
}