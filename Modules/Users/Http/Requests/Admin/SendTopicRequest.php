<?php

namespace Modules\Users\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SendTopicRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "ar" => "required|array:title,body",
            "ar.title" => 'required|string|min:3|max:120',
            "ar.body" => 'required|string|min:3|max:400',

            "en" => "required|array:title,body",
            "en.title" => 'required|string|min:3|max:120',
            "en.body" => 'required|string|min:3|max:400',
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