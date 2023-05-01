<?php

namespace Modules\Auth\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Country\Entities\Country;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country'       => 'required|numeric|exists:countries,id',
            'phone'         => ['required', 'string', 'min:8', 'max:120'],
            'password'      => 'required|string|min:8|max:120',
            'mobile_token'  => 'required|string|min:3|max:220',
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
    public function getCredentials()
    {
        return $this->only(['phone', 'password']);
    }
}