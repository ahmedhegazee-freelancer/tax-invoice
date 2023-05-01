<?php

namespace Modules\Auth\Services;

use App\Exceptions\DeviceNotFoundException;
use App\Exceptions\UserIsBlocked;
use App\Exceptions\UserIsNotCustomer;
use App\Exceptions\UserIsNotVerified;
use App\Exceptions\WrongCredentials;
use App\Helpers\UserData;
use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\DataTransferObject\DeviceDTO;
use Modules\Auth\Entities\Device;
use Modules\Auth\Entities\User;
use Modules\Auth\Http\Requests\Api\LoginRequest;
use Modules\Country\Services\CountryService;

class LoginService
{
    use UserData;
    public function handle(LoginRequest $request): array|WrongCredentials|UserIsBlocked|UserIsNotCustomer|UserIsNotVerified
    {
        $phone = $request->get('phone');
        CountryService::validate($request->get('country'), $phone);

        if (Auth::attempt($request->getCredentials())) {
            $user = Auth::user();
            $this->isCustomer($user);
            $this->isUserVerified($user);
            $this->isUserBlocked($user);
            $user->update(['mobile_token' => $request->mobile_token]);
            $user->tokens()->delete();
            return $this->getData($user);
        }
        throw new WrongCredentials();
    }
    public function isUserBlocked(User $user)
    {
        if ($user->isBlocked())
            throw new UserIsBlocked();
    }
    public function isUserVerified(User $user)
    {
        if (!$user->hasVerifiedEmail())
            throw new UserIsNotVerified();
    }
    public function isCustomer(User $user)
    {
        if (!$user->hasRole('customer'))
            throw new UserIsNotCustomer();
    }
}