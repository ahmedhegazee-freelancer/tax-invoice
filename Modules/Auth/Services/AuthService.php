<?php

namespace Modules\Auth\Services;

use App\Helpers\UserData;
use Modules\Auth\DataTransferObject\EmailVerificationDTO;
use Modules\Auth\DataTransferObject\SendOtpDTO;
use Modules\Auth\Entities\EmailVerification;
use Modules\Auth\Entities\PasswordReset;
use Modules\Auth\Http\Requests\Api\ForgetPasswordRequest;
use Modules\Auth\Http\Requests\Api\LoginRequest;
use Modules\Auth\Http\Requests\Api\RegisterRequest;
use Modules\Auth\Http\Requests\Api\ResetPasswordRequest;
use Modules\Auth\Http\Requests\Api\SendOTPRequest;
use Modules\Country\Entities\Country;
use Modules\Country\Services\CountryService;

class AuthService
{
    use UserData;
    public function login(LoginRequest $request)
    {
        return (new LoginService())->handle($request);
    }
    public function register(RegisterRequest $request)
    {
        return (new RegisterService())->handle($request);
    }
    public function sendOTP(SendOTPRequest $request)
    {
        $phone = $request->get('email');
        // CountryService::validate($request->get('country'), $phone);
        return (new OTPService)->send($phone, 'verify');
    }
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $phone = $request->get('email');
        // CountryService::validate($request->get('country'), $phone);
        return (new OTPService)->send($phone, 'reset');
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        return (new ResetPasswordService)->handle($request);
    }
    public function getUserData()
    {
        return $this->getData(auth()->user());
    }
}
