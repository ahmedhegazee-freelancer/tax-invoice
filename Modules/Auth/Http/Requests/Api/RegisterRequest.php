<?php

namespace Modules\Auth\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Auth\Rules\EmailUniqueRule;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->request->get('date_of_birth'));
        return [
            'first_name' => ['required', 'string', 'min:3', 'max:120', 'regex:/^([a-zA-Z]*)|([\p{Arabic}]*)$/'],
            'middle_name' => ['required', 'string', 'min:3', 'max:120', 'regex:/^([a-zA-Z]*)|([\p{Arabic}]*)$/'],
            'last_name' => ['required', 'string', 'min:3', 'max:120', 'regex:/^([a-zA-Z]*)|([\p{Arabic}]*)$/'],
            'password' => 'required|string|confirmed|min:8|max:120',
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'min:8', 'max:120', 'unique:users,phone'],
            'country' => 'required|numeric|exists:countries,id',
            'date_of_birth' => 'required|date|date_format:Y-m-d|before:' . now()->subYears(12),
            'gender' => 'required|string|in:male,female',
            'instagram_account' => ['sometimes', 'string', 'min:3', 'max:120', 'regex:/^(@[a-z0-9_.+-@]*)$/'],
            'club_name' => 'sometimes|string|min:3|max:120',
            'nationality' => 'required|numeric|exists:nationalities,id',
            'profile' => 'nullable|image|mimes:png,jpg|max:10240',
            'code' => 'required|string|size:6',
            'mobile_token' => 'required|string|min:3|max:220',
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