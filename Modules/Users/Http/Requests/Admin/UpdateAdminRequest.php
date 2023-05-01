<?php

namespace Modules\Users\Http\Requests\Admin;

use App\Rules\ExistsRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'roles' => ['required', 'array'],
            'roles.*' => ['required', 'numeric', 'exists:roles,id']
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