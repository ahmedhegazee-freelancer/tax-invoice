<?php

namespace Modules\Users\DataTransferObjects;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Auth\Services\AgeGroupService;
use Modules\Country\Entities\Country;

class CreateUserDto
{
    private string $profileUrl = 'default/profile_default.png';
    private Country $country;

    public function __construct(
        private FormRequest $request
    ) {
        if ($request->file('profile'))
            $this->setProfile($request->file('profile'));
    }
    public function setProfile(UploadedFile $profileImage)
    {
        $this->profileUrl = \upload_image($profileImage, 'profile');
    }
    public function setCountry(Country $country)
    {
        $this->country = $country;
    }
    public function toArray(): array
    {
        $dateOfBirth = $this->request->get('date_of_birth', now()->subYears(18)->format('Y-m-d'));
        $age = AgeGroupService::calculate($dateOfBirth);
        $password = $this->request->get('password', '12345678');
        return $this->request->merge([
            'date_of_birth' => $dateOfBirth,
            'profile_photo_path' => $this->profileUrl,
            'password' => Hash::make($password),
            'uuid' => Str::uuid()->toString(),
            'age_group_id' => AgeGroupService::findGroupID($age),
            'age' => $age,
            'country_id' => $this->country->id,
            'country_code' => $this->country->phone_code,
            'nationality_id' => $this->request->get('nationality'),
            'gender_id' => set_gender($this->request->get('gender')),
            'email_verified_at' => now()->toDateTimeString(),
        ])->all();
    }
}