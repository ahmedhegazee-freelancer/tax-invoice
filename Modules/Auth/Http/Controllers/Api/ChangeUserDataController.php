<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Helpers\JsonResponseMessages;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\Api\SendOTPRequest;
use Modules\Auth\Http\Requests\Api\UpdatePasswordRequest;
use Modules\Auth\Http\Requests\Api\UpdateEmailRequest;
use Modules\Auth\Http\Requests\Api\UpdateProfileImageRequest;
use Modules\Auth\Http\Requests\Api\UpdateProfileRequest;
use Modules\Auth\Services\UpdateUserService;

class ChangeUserDataController extends Controller
{
    public function __construct(private UpdateUserService $service)
    {
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $this->service->updatePassword($request->get('old_password'), $request->get('password'));
        return JsonResponseMessages::updated();
    }
    public function updateProfileImage(UpdateProfileImageRequest $request)
    {
        $this->service->updateProfileImage($request->file('profile'));
        return JsonResponseMessages::updated();
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->service->updateProfile($request);
        return JsonResponseMessages::updated();
    }
    public function updateEmail(UpdateEmailRequest $request)
    {
        $this->service->updateEmail($request);
        return JsonResponseMessages::updated();
    }
}
