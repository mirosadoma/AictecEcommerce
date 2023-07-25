<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class SearchProductsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = [
            'id'                => (int) $this->id,
            'title'             => (string) $this->title,
            'main_image'        => (string) $this->main_image_path,
            'created_at'        => (string) $this->created_at->diffForHumans() ?? "",
        ];
        return $result;
    }
}
