<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsFilesResources extends JsonResource
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
            'size'              => (string) $this->size." KB",
            'file'              => (string) $this->file_path,
            'created_at'        => (string) $this->created_at ? $this->created_at->diffForHumans() : "",
        ];
    }
}
