<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;


class ProductsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $is_fav = 0;
        if (!is_null(Auth::guard('api')->user())) {
            if (in_array($this->id, Auth::guard('api')->user()->favorites->pluck('id')->toArray())) {
                $is_fav = 1;
            }
        }

        $result = [
            'id'                    => (int) $this->id,
            'title'                 => (string) $this->title??"",
            'small_description'     => (string) $this->small_description??"",
            'quantity'              => (int) $this->quantity??0,
            'category'              => (string) $this->category->name??"",
            'price'                 => (float) $this->price,
            'model'                 => (string) $this->model??"",
            'old_price'             => (float) $this->old_price,
            'is_fav'                => (float) $is_fav,
            'qty_count'             => (int) 0,
            'show_btn'              => (bool) true,
            'main_image'            => (string) $this->main_image_path,
            'created_at'            => (string) $this->created_at ? $this->created_at->diffForHumans() : "",
        ];
        return $result;
    }
}
