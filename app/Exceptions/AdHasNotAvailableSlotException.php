<?php

namespace App\Exceptions;

use Exception;

class AdHasNotAvailableSlotException extends Exception
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
            'message' => trans('messages.ad_has_not_available_slots'),
        ], 404);
    }
}