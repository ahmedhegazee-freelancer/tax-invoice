<?php

namespace Modules\Users\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $exceptID = '';
        if (isset($this->role))
            $exceptID = ',' . $this->role->id;
        return [
            'name' => 'required|string|min:3|max:120|unique:roles,name' . $exceptID,
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'required|numeric|exists:permissions,id'
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