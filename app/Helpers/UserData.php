<?php

namespace App\Helpers;

use Modules\Auth\Entities\Device;
use Modules\Auth\Entities\User;

trait UserData
{
    private function getData(User $user): array
    {
        return [
            'id' => $user->uuid,
            'first_name' => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name' => $user->last_name,
            'full_name' => $user->full_name,
            'phone' => (string)\str_replace($user->country_code, '', $user->phone,),
            'country' => (int)$user->country_id,
            'nationality' => (int)$user->nationality_id,
            'email' => $user->email,
            'gender' => $user->gender,
            'date_of_birth' => $user->date_of_birth,
            'profile' => $user->getProfilePhotoUrlAttribute(),
            'token' => $user->createToken('loginToken')->plainTextToken,
            'instagram_account' => $user->instagram_account,
            'club_name' => $user->club_name,
        ];
    }
}