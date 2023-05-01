<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;

class Category
{
    public function handle($request, Closure $next)
    {
        if (request()->has('category')) {
            return $next($request)->where('category_id', request()->get('category'));
        }
        return $next($request);
    }
}