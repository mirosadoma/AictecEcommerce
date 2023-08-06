<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResources extends JsonResource
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
            'start_date'        => (string) $this->start_date??"",
            'end_date'          => (string) $this->end_date??"",
            'code'              => (string) $this->code??"",
            'type'              => (string) $this->type??"",
            'value'             => (string) $this->value??"",
            'name'              => (string) $this->name??"",
            'created_at'        => (string) $this->created_at ? $this->created_at->diffForHumans() : "",
        ];
    }
}
