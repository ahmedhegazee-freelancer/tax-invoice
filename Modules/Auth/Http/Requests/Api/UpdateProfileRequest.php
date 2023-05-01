<?php

namespace Modules\Auth\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Rules\EmailUniqueExceptRule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'first_name' => ['required', 'string', 'min:3', 'max:120', 'regex:/^([a-zA-Z]*)|([\p{Arabic}]*)$/'],
            'middle_name' => ['required', 'string', 'min:3', 'max:120', 'regex:/^([a-zA-Z]*)|([\p{Arabic}]*)$/'],
            'last_name' => ['required', 'string', 'min:3', 'max:120', 'regex:/^([a-zA-Z]*)|([\p{Arabic}]*)$/'],
            // 'email' => ['required', 'string', 'email', 'unique:users,email,' . auth()->id()],
            'country' => 'required|numeric|exists:countries,id',
            'phone' => ['required', 'string', 'unique:users,phone,' . auth()->id()],
            'date_of_birth' => 'required|date|date_format:Y-m-d|before:' . now()->subYears(12),
            'gender' => 'required|string|in:male,female',
            'instagram_account' => ['sometimes', 'string', 'min:3', 'max:120', 'regex:/^(@[a-z0-9_.+-@]*)$/'],
            'club_name' => 'sometimes|string|min:3|max:120',
            'nationality' => 'required|numeric|exists:nationalities,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
