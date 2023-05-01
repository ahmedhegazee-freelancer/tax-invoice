<?php

namespace Modules\Users\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Rules\EmailUniqueExceptRule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userID = $this->user->id;
        return [
            'email' => 'required|email|unique:users,email,' . $userID,
            'country' => 'required|numeric|exists:countries,id',
            'first_name' => ['required', 'string', 'min:3', 'max:120', 'regex:/^([a-zA-Z]*)|([\p{Arabic}]*)$/'],
            'middle_name' => ['required', 'string', 'min:3', 'max:120', 'regex:/^([a-zA-Z]*)|([\p{Arabic}]*)$/'],
            'last_name' => ['required', 'string', 'min:3', 'max:120', 'regex:/^([a-zA-Z]*)|([\p{Arabic}]*)$/'],
            'nationality' => 'required|numeric|exists:nationalities,id',
            'gender' => 'required|string|in:male,female',
            'phone' => ['required', 'string', 'min:8', 'max:120', 'unique:users,phone,' . $userID],
            'date_of_birth' => 'required|date|date_format:Y-m-d|before:' . now()->subYears(12),
            'instagram_account' => ['sometimes', 'string', 'min:3', 'max:120', 'regex:/^(@[a-z0-9_.+-@]*)$/'],
            'club_name' => 'sometimes|string|min:3|max:120',
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