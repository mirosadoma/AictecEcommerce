<?php

namespace App\Http\Resources\Api;

use App\Models\Products\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\ProductsImagesResources;
use App\Http\Resources\Api\ProductsOptionsResources;
use App\Http\Resources\Api\ProductsResources;
use App\Http\Resources\Api\ProductsFeaturesResources;


class ProductsCollections extends JsonResource
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
        $brand = [];
        if ($this->brand) {
            $brand = [
                'name'  => (string) $this->brand->name??"",
                'image' => (string) $this->brand->image_path??"",
            ];
        }

        $simillar_products = Product::where('brand_id', $this->brand_id)->where('category_id', $this->category_id)->take(12)->get();
        $product_images = [];
        $product_images_array = array_reverse($this->product_images()->pluck('image')->toArray());
        foreach ($product_images_array as $value) {
            $value = ($value) && file_exists(str_replace('/', '\\',public_path($value))) ? url($value) : url('assets/logo.png');
            $product_images[] = (object)  ['image'=>$value];
        }
        $product_images[] = (object)  ['image'=>$this->main_image_path];
        $product_images = array_reverse($product_images);

        $result = [
            'id'                    => (int) $this->id,
            'is_fav'                => (int) $is_fav,
            'brand'                 => (array) $brand,
            'quantity'              => (int) $this->quantity??0,
            'title'                 => (string) $this->title??"",
            'category'              => (string) $this->category->name??"",
            'small_description'     => (string) $this->small_description??"",
            'model'                 => (string) $this->model??"",
            'price'                 => (float) $this->price,
            'old_price'             => (float) $this->old_price,
            // 'main_image'            => (string) $this->main_image_path??"",
            'images'                => (array) $product_images,
            'description'           => (string) $this->description??"",
            'basic_features'        => (array) ($this->product_features->count()) ? ProductsFeaturesResources::collection($this->product_features) : [],
            'additional_options'    => (array) ($this->product_options->count()) ? ProductsOptionsResources::collection($this->product_options) : [],
            'files'                 => (array) ($this->product_files->count()) ? ProductsFilesResources::collection($this->product_files) : [],
            'simillar_products'     => (array) ($simillar_products->count()) ? ProductsResources::collection($simillar_products) : [],
            'created_at'            => (string) $this->created_at ? $this->created_at->diffForHumans() : "",
        ];
        return $result;
    }
}
