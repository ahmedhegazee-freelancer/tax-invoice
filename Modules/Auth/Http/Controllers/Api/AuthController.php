<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Helpers\JsonResponseMessages;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\Api\ForgetPasswordRequest;
use Modules\Auth\Http\Requests\Api\LoginRequest;
use Modules\Auth\Http\Requests\Api\RegisterRequest;
use Modules\Auth\Http\Requests\Api\ResetPasswordRequest;
use Modules\Auth\Http\Requests\Api\SendOTPRequest;
use Modules\Auth\Rules\EmailExistsRule;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Transformers\OtpResource;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {
    }
    public function login(LoginRequest $request)
    {
        return $this->service->login($request);
    }
    public function register(RegisterRequest $request)
    {
        return $this->service->register($request);
    }
    public function sendOTP(SendOTPRequest $request)
    {
        //in case of register
        return new OtpResource($this->service->sendOTP($request));
    }
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        return new OtpResource($this->service->forgetPassword($request));
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->service->resetPassword($request);
    }
    public function userData()
    {
        return $this->service->getUserData();
    }
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return JsonResponseMessages::logout();
    }
    public function destroy()
    {
        auth()->user()->delete();
        return JsonResponseMessages::deleted();
    }
}