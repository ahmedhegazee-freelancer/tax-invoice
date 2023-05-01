<?php

namespace App\Exceptions;

use Exception;

class VerificationCodeIsNotValid extends Exception
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
            'message' => trans('messages.verification_code_is_not_valid'),
        ], 422);
    }
}