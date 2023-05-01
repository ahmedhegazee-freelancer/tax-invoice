<?php

namespace App\Exceptions;

use App\Helpers\FCMHelper as HelpersFCMHelper;
use App\Traits\FCMHelper;
use Exception;

class PaymentConflictException extends Exception
{
    public function __construct(private string $token)
    {
    }
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        $notification = [
            "body" => __('messages.payment_failed'),
            "title" => __('messages.payment_failed'),
        ];
        HelpersFCMHelper::sendMessage($this->token,  $notification, true);
        return $request->isJson() ? response()->json([
            'message' => trans('messages.payment_failed'),
        ], 422) : response()->view('errors.payment');
    }
}