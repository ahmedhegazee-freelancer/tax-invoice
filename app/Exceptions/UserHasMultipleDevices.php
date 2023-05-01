<?php

namespace App\Exceptions;

use Exception;

class UserHasMultipleDevices extends Exception
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
            'device' => $request->get('device'),
            'message' => trans('messages.user_has_many_devices'),
        ], 400);
    }
}