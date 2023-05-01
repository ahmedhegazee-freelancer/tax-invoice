<?php

namespace Modules\Coupon\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|string|min:3|max:120|unique:coupons,code',
            'amount' => 'required|numeric|min:1|max:1000',
            'ended_at' => 'required|date|date_format:Y-m-d|after_or_equal:tomorrow',
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