<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Components\Advertises\Resources\Api\AdvertiseResources;

class CommonQuestionsResources extends JsonResource
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
            'question'          => (string) $this->question??"",
            'answer'            => (string) $this->answer??"",
            'created_at'        => (string) $this->created_at ? $this->created_at->diffForHumans() : "",
        ];
    }
}
