<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;

class Search
{
    public function handle($request, Closure $next)
    {
        $search = request()->get('search');
        if (request()->has('search') && $search != null) {
            return $next($request)->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('middle_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
        }
        return $next($request);
    }
}