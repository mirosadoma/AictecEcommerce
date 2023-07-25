<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Resources
use App\Http\Resources\Api\SearchProductsResources;
use App\Http\Resources\Api\AllCategoriesResources;
use App\Http\Resources\Api\AllBannersResources;
use App\Http\Resources\Api\ProductsResources;
use App\Http\Resources\Api\SiteSettingsResources;
use App\Http\Resources\Api\ProductsCollections;
// Models
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\SiteConfig;
use App\Models\Categories\Category;
use App\Models\Products\Product;
use App\Models\Banners\Banner;
use App\Models\Orders\OrderProducts;
use App\Support\API;
use Illuminate\Support\Facades\DB;

// use App\Models\User;

class MainController extends Controller {

    public function site_settings(){
        $setting = SiteConfig::first();
        return (new API)
            ->isOk(__('Site Settings'))
            ->setData(new SiteSettingsResources($setting))
            ->build();
    }

    public function all_banners(){
        $all_banners = Banner::where('is_active', 1)->orderBy('id', 'DESC')->get();
        return (new API)
            ->isOk(__('All Banners'))
            ->setData(AllBannersResources::collection($all_banners))
            ->build();
    }

    public function all_categories(){
        $all_categories = Category::where('is_active', 1)->where('in_site', 1)->orderBy('id', 'DESC')->get();
        return (new API)
            ->isOk(__('All Categories'))
            ->setData(AllCategoriesResources::collection($all_categories))
            ->build();
    }

    public function show_product(Product $product) {
        return (new API)
            ->isOk(__('Show Product Data'))
            ->setData(new ProductsCollections($product))
            ->build();
    }

    public function latest_products(){
        $latest_products = Product::where('is_active', 1)->orderBy('id', 'DESC')->take(6)->get();
        return (new API)
            ->isOk(__('Latest Products'))
            ->setData(ProductsResources::collection($latest_products))
            ->build();
    }

    public function best_selling_products(){
        $latest_products = Product::leftJoin('order_products','products.id','=','order_products.product_id')
            ->selectRaw('products.* ,COALESCE(sum(order_products.quantity),0) total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->get();
        return (new API)
            ->isOk(__('Best Selling Products'))
            ->setData(ProductsResources::collection($latest_products))
            ->build();
    }

    public function search(){
        $products = Product::query()->where('is_active', 1);
        if (request()->has("search_key") && !empty(request('search_key'))) {
            $products = $products->whereTranslationLike("title","%".request('search_key')."%")->orWhere('model', 'LIKE', '%'.request('search_key').'%')->orderBy('id', 'DESC')->get();
        }else{
            $products = [];
        }
        return (new API)
            ->isOk(__('Search Reasult'))
            ->setData(SearchProductsResources::collection($products))
            ->build();
    }
}
