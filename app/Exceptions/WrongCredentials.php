<?php

namespace App\Exceptions;

use Exception;

class WrongCredentials extends Exception
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
            'message' => trans('auth.failed'),
        ], 422);
    }
}