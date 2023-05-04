<?php

namespace Modules\Branch\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchsResource extends JsonResource
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
            'url' => $this->formatted_url,
        ];
    }
}
