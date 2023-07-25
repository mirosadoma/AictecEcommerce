<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsOptionsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => (int) $this->id,
            'name'              => (string) $this->name,
            'value'             => (string) $this->value,
        ];
    }
}
