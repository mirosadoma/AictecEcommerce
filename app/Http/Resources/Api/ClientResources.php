<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $is_verified = 0;
        // if(is_null($this->phone_verified_at)){
        //     $is_verified = 0;
        // }else{
        //     $is_verified = 1;
        // }
        $data = [
            'id'                => (int) $this->id,
            'name'              => (string) $this->name,
            'email'             => (string) $this->email,
            'phone'             => (string) $this->phone,
            // 'is_verified'       => (bool) $is_verified,
            'type'              => (string) $this->type,
            'created_at'        => (string) $this->created_at->diffForHumans() ?? "",
        ];
        return $data;
    }
}
