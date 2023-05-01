<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Hash;
use Modules\Auth\DataTransferObject\EmailVerificationDTO;
use Modules\Auth\DataTransferObject\VerificationDTO;
use Modules\Auth\Entities\PasswordReset;
use Modules\Auth\Entities\User;
use Modules\Auth\Http\Requests\Api\ResetPasswordRequest;
use Modules\Country\Services\CountryService;

class ResetPasswordService
{

    public function handle(ResetPasswordRequest $request)
    {
        $email = $request->get('email');
        // CountryService::validate($request->get('country'), $phone);2
        $otpService = new OTPService();
        $verificationDto = new VerificationDTO(
            $email,
            $request->get('code'),
            'reset',
        );
        $otpService->validate($verificationDto);
        User::where('email', $email)
            ->update(['password' => Hash::make($request->get('password'))]);
        return response()->json([
            'message' => __('messages.success_update'),
        ]);
    }
}
