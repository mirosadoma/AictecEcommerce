<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Components\Advertises\Resources\Api\AdvertiseResources;

class AllBrandsResources extends JsonResource
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
            'name'              => (string) $this->name??"",
        ];
    }
}
