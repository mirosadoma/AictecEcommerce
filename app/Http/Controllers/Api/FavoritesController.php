<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Resources
use App\Http\Resources\Api\ProductsResources;
// Models
use App\Models\Addressess\Address;
use App\Support\API;

class FavoritesController extends Controller {

    public function my_favorites(){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        return (new API)
            ->isOk(__('Your Favorites Data'))
            ->setData(ProductsResources::collection($user->favorites))
            ->addAttribute("paginate",api_model_set_paginate($user->favorites()->paginate()))
            ->build();
    }

    public function update_favorites(Request $request, $product){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        $is_fav = in_array($product, Auth::guard('api')->user()->favorites->pluck('id')->toArray());
        if ($is_fav) {
            $user->favorites()->detach($product);
            return (new API)
                ->isOk(__('Removed from favourites'))
                ->setData([
                    'id'        => $product->id,
                    'is_fav'    => 0
                ])
                ->build();
        } else {
            $user->favorites()->attach($product);
            return (new API)
                ->isOk(__('Added to favourites'))
                ->setData([
                    'id'        => $product->id,
                    'is_fav'    => 1
                ])
                ->build();
        }
    }

}
