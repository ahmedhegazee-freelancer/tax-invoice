<?php

namespace Modules\Auth\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Rules\EmailExistsRule;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'phone' => ['required', 'string', 'exists:users,phone'],
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            // 'country' => 'required|numeric|exists:countries,id',
            'code' => 'required|string|size:6',
            'password' => 'required|string|confirmed|min:8|max:120',
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
