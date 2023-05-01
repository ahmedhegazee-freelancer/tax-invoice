<?php

namespace Modules\Auth\Services;

use App\Helpers\UserData;
use Modules\Auth\DataTransferObject\DeviceDTO;
use Modules\Auth\DataTransferObject\EmailVerificationDTO;
use Modules\Auth\DataTransferObject\VerificationDTO;
use Modules\Auth\Entities\EmailVerification;
use Modules\Auth\Entities\User;
use Modules\Auth\Http\Requests\Api\RegisterRequest;
use Modules\Country\Services\CountryService;
use Illuminate\Support\Str;
use Modules\Country\Entities\Country;
use Modules\Users\DataTransferObjects\CreateUserDto;
use Modules\Users\Services\UserService;

class RegisterService
{
    use UserData;
    //1)verify code
    //2) validate phone and country code
    //3)calculate age and get group
    //4) create new user
    public function handle(RegisterRequest $request)
    {
        $phone = $request->get('email');
        // $country = CountryService::validate($request->get('country'), $phone);
        $country = Country::where('id', $request->get('country'))->first();
        $otpService = new OTPService();
        $verificationDto = new VerificationDTO(
            $phone,
            $request->get('code'),
            'verify',
        );
        $otpService->validate($verificationDto);
        $createUserDto = new CreateUserDto($request);
        $createUserDto->setCountry($country);
        $customer = (new UserService)->createCustomer($createUserDto);
        return $this->getData($customer);
    }
}
