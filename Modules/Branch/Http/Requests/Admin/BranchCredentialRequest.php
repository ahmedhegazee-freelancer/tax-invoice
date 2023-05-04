<?php

namespace Modules\Branch\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BranchCredentialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'device_serial_number'  => 'required|string|min:1|max:120',
            'client_id'             => 'required|string|min:1|max:120',
            'client_secret'         => 'required|string|min:1|max:120',
            'pos_os_version'        => 'required|string|min:1|max:120',
            'is_prod'               => 'required|boolean'
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