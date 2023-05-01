<?php

namespace App\Exceptions;

use Exception;

class UserIsNotVerified extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json([
            'message' => trans('auth.not_verified'),
        ], 422);
    }
}