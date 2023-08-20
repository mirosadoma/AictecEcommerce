<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResources extends JsonResource
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
            'full_name'         => (string) $this->full_name??"",
            'phone'             => (string) $this->phone??"",
            'street_address'    => (string) $this->street_address??"",
            'building_number'   => (string) $this->building_number??"",
            'floor_number'      => (string) $this->floor_number??"",
            'postal_code'       => (string) $this->postal_code??"",
            'is_default'        => (bool) $this->is_default??"",
            'type'              => (string) $this->type??"",
            'lat'               => (string) $this->lat??"",
            'lng'               => (string) $this->lng??"",
            'google_address'    => (string) $this->google_address??"",
            'city_id'           => (string) $this->city->name??"",
            'district'          => (string) $this->district??"",
        ];
    }
}
