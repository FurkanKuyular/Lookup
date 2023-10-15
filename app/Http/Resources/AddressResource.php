<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /** @var AddressResource */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'address' => $this->resource->address,
            'post_cpde' => $this->resource->post_code,
            'city_name' => $this->resource->city_name,
            'country_name' => $this->resource->country_name,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
