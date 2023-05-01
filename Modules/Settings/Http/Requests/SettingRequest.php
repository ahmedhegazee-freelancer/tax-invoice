<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => ['required', 'string', 'regex:/^(\+974)(5|4|3|6|3|7)([0-9]{7})$/'],
            'whatsapp' => ['required', 'string', 'regex:/^(\+974)(5|4|3|6|3|7)([0-9]{7})$/'],
            'facebook' => ['required', 'string', 'url'],
            'instagram' => ['required', 'string', 'url'],
            'twitter' => ['required', 'string', 'url'],
            'snapchat' => ['required', 'string', 'url'],
            'youtube' => ['required', 'string', 'url'],
            // 'version' => ['required', 'string', 'regex:/^(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)$/'],
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