<?php

namespace App\Exceptions;

use Exception;

class VerificationCodeIsSent extends Exception
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
            'message' => trans('auth.verification_code_is_sent_less_than_2_minutes'),
        ], 422);
    }
}