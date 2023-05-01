<?php

namespace App\Exceptions;

use Exception;

class TicketsAreNotAvailableException extends Exception
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
            'message' => trans('messages.tickets_are_not_available'),
        ], 422);
    }
}