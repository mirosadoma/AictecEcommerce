<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Support\API;
// Requests
use App\Http\Requests\Api\Main\NewsletterRequest;
use App\Http\Requests\Api\Main\ContactUsRequest;
use App\Http\Requests\Api\Main\ClaimsRequest;
// Resources
use App\Http\Resources\Api\AllCategoriesResources;
use App\Http\Resources\Api\AllBrandsResources;
use App\Http\Resources\Api\AllReasonsResources;
use App\Http\Resources\Api\AllPaymentMethodsImagesResources;
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
use App\Models\Brands\Brand;
use App\Models\Claims\Claim;
use App\Models\Claims\Reason;
use App\Models\ContactUs\ContactUs;
use App\Models\Newsletters\Newsletter;
use App\Models\Orders\OrderProducts;
use App\Models\PaymentMethodsImages\PaymentMethodsImage;

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

    public function all_brands(){
        $all_brands = Brand::where('is_active', 1)->orderBy('id', 'DESC')->get();
        return (new API)
            ->isOk(__('All Brands'))
            ->setData(AllBrandsResources::collection($all_brands))
            ->build();
    }

    public function all_resons(){
        $all_resons = Reason::where('is_active', 1)->get();
        return (new API)
            ->isOk(__('All Reasons'))
            ->setData(AllReasonsResources::collection($all_resons))
            ->build();
    }

    public function all_payment_methods_images(){
        $all_payment_methods_images = PaymentMethodsImage::where('is_active', 1)->orderBy('id', 'DESC')->get();
        return (new API)
            ->isOk(__('All Payment Methods Images'))
            ->setData(AllPaymentMethodsImagesResources::collection($all_payment_methods_images))
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
            ->take(6)
            ->get();
        return (new API)
            ->isOk(__('Best Selling Products'))
            ->setData(ProductsResources::collection($latest_products))
            ->build();
    }

    public function search(){
        $products = Product::query()->where('is_active', 1);
        if (request()->has("search_key") && !empty(request('search_key'))) {
            $products->whereTranslationLike("title","%".request('search_key')."%")->orWhere('model', 'LIKE', '%'.request('search_key').'%');
        }
        $products = $products->orderBy('id', "DESC")->paginate();
        if($products->count()){
            return (new API)
                ->isOk(__('Search Reasult'))
                ->setData(ProductsResources::collection($products))
                ->addAttribute("search_data",['products_count'=>$products->count(),'search_key' => request('search_key')])
                ->addAttribute("paginate",api_model_set_paginate($products))
                ->build();
        }else{
            return (new API)
                ->isOk(__('No Products Found'))
                ->setData(ProductsResources::collection($products))
                ->addAttribute("search_data",['products_count'=>$products->count(),'search_key' => request('search_key')])
                ->addAttribute("paginate",api_model_set_paginate($products))
                ->build();
        }

    }

    public function products_filter(){
        $products = Product::query()->where('is_active', 1);
        if (request()->has("brand_id") && !empty(request('brand_id'))) {
            $products->where("brand_id",request('brand_id'));
        }elseif (request()->has("category_id") && !empty(request('category_id'))) {
            $products->where("category_id",request('category_id'));
        }elseif (request()->has("min_price") && !empty(request('min_price'))) {
            $products->where("price",'>',request('min_price'));
        }elseif (request()->has("max_price") && !empty(request('max_price'))) {
            $products->where("price",'<',request('max_price'));
        }
        if (request()->has("price_sort") && !empty(request('price_sort'))) {
            $products = $products->orderBy('price', request('price_sort'))->paginate();
        }else{
            $products = $products->orderBy('id', "DESC")->paginate();
        }
        if($products->count()){
            return (new API)
                ->isOk(__('Search Reasult'))
                ->setData(ProductsResources::collection($products))
                ->addAttribute("filter_data",[
                    'products_count'=>$products->count(),
                    'brand_id'      => request('brand_id'),
                    'category_id'   => request('category_id'),
                    'min_price'     => request('min_price'),
                    'max_price'     => request('max_price'),
                    'price_sort'    => request('price_sort'),
                ])
                ->addAttribute("paginate",api_model_set_paginate($products))
                ->build();
        }else{
            return (new API)
                ->isOk(__('No Products Found'))
                ->setData(ProductsResources::collection($products))
                ->addAttribute("filter_data",[
                    'products_count'=>$products->count(),
                    'brand_id'      => request('brand_id'),
                    'category_id'   => request('category_id'),
                    'min_price'     => request('min_price'),
                    'max_price'     => request('max_price'),
                    'price_sort'    => request('price_sort'),
                ])
                ->addAttribute("paginate",api_model_set_paginate($products))
                ->build();
        }

    }

    public function add_newsletter(NewsletterRequest $request) {
        $sub = Newsletter::where('email', 'like', '%'.$request->email.'%')->first();
        if ($sub) {
            return (new API)
                ->isError(__('You are already registered with us'))
                ->build();
        }else{
            Newsletter::create($request->all());
            return (new API)
                ->isOk(__('Data Saved Successfully'))
                ->build();
        }
    }

    public function send_contact(ContactUsRequest $request) {
        $data = $request->all();
        if (Auth::guard('api')->check()) {
            $data['user_id'] = Auth::guard('api')->user()->id;
        }
        ContactUs::create($data);
        return (new API)
                ->isOk(__('Data Saved Successfully'))
                ->build();
    }

    public function send_claim(ClaimsRequest $request) {
        $data = $request->all();
        if (Auth::guard('api')->check()) {
            $data['claimer_id'] = Auth::guard('api')->user()->id;
        }
        $claim = Claim::create($data);
        if ($request->resons) {
            $claim->resons()->attach($request->resons);
        }
        return (new API)
                ->isOk(__('Data Saved Successfully'))
                ->build();
    }
}
