<?php

namespace Modules\Auth\Services;

use App\Exceptions\OldPasswordIsInvalidException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\DataTransferObject\VerificationDTO;
use Modules\Auth\Http\Requests\Api\UpdateEmailRequest;
use Modules\Auth\Http\Requests\Api\UpdateProfileRequest;
use Modules\Country\Entities\Country;
use Modules\Country\Services\CountryService;

class UpdateUserService
{

    public function updatePassword(string $oldPassword, string $newPassword)
    {
        $this->isCorrectPassword($oldPassword);
        auth()->user()->update(['password' => Hash::make($newPassword)]);
    }
    public function isCorrectPassword(string $oldPassword)
    {
        if (!Hash::check($oldPassword, auth()->user()->password))
            throw new OldPasswordIsInvalidException();
    }
    public function updateProfileImage(UploadedFile $image)
    {
        auth()->user()->updateProfilePhoto($image);
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $phone = $request->get('phone');
        $country = CountryService::validate($request->get('country'), $phone);
        $age = AgeGroupService::calculate($request->get('date_of_birth'));
        $request->merge([
            'gender_id' => set_gender($request->get('gender')),
            'nationality_id' => $request->get('nationality'),
            'age_group_id' => AgeGroupService::findGroupID($age),
            'age' => $age,
            'country_id' => $country->id,
            'country_code' => $country->phone_code,
        ]);
        auth()->user()->update($request->all());
    }
    public function updateEmail(UpdateEmailRequest $request)
    {
        // $phone = $request->get('phone');
        // $country = CountryService::validate($request->get('country'), $phone);
        $email = $request->get('email');
        $otpService = new OTPService();
        $verificationDto = new VerificationDTO(
            $email,
            $request->get('code'),
            'verify',
        );
        $otpService->validate($verificationDto);
        auth()->user()->update([
            'email' => $email,
            // 'country_id' => $request->get('country'),
            // 'country_code' => $country->phone_code,
        ]);
    }
}
