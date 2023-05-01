<?php

namespace App\Helpers;

use App\Exceptions\SMSException;
use Illuminate\Support\Facades\Http;

class SMSService
{
    public static function send(string $phone, string $code)
    {

        $apiKey = config('sms.api_key');
        $senderName = config('sms.sender_name');
        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $apiKey,
        ])->post("https://api.releans.com/v2/message", [
            "sender" => $senderName,
            "mobile" => $phone,
            "content" => "كود التحقق" . $code,
        ]);
        if ($response->json()['code'] != 77)
            throw new SMSException();
    }
}