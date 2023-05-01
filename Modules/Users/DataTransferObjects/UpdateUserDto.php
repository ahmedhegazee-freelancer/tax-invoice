<?php

namespace Modules\Users\DataTransferObjects;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Entities\User;
use Modules\Auth\Services\AgeGroupService;
use Modules\Country\Entities\Country;

class UpdateUserDto
{
    private Country $country;
    public function __construct(
        private FormRequest $request
    ) {
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
    }
    private function updateAge()
    {
        $age = AgeGroupService::calculate($this->request->get('date_of_birth'));
        $this->request->merge([
            'age_group_id' => AgeGroupService::findGroupID($age),
            'age' => $age,
        ]);
    }
    public function toArray(): array
    {
        if ($this->request->has('date_of_birth')) {
            $this->updateAge();
        }
        return $this->request->merge([
            'gender_id' => \set_gender($this->request->get('gender')),
            'country_id' => $this->country->id,
            'country_code' => $this->country->phone_code,
            'nationality_id' => (int)$this->request->get('nationality'),
        ])->all();
    }
}