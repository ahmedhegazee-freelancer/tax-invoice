<?php

namespace Modules\Auth\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class OtpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'phone' => $this->phone,
            'code' => $this->code,
            'expired_at' => $this->expired_at->toDateTimeString(),
        ];
    }
}