<?php

namespace Modules\Auth\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Auth\Entities\User;

class EmailExistsRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $team = request()->get('team');
        return User::where('email', $value)->where('team_id', $team->id)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.exists');
    }
}