<?php

namespace App\Http\Resources;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /** @var Person */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'birthday' => $this->resource->birthday,
            'gender' => $this->resource->gender,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
