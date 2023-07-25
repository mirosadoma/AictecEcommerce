<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Products\ProductOptions;
use Illuminate\Http\Request;
// Models
use App\Models\Products\Product;
use App\Models\Products\ProductImages;
use App\Models\Categories\Category;
use App\Models\Brands\Brand;
// Requests
use App\Http\Requests\Dashboard\Products\StoreRequest;
use App\Http\Requests\Dashboard\Products\UpdateRequest;

class ProductsController extends Controller {

    public function index() {
        if (!permissionCheck('products.view')) {
            return abort(403);
        }
        $lists = Product::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->whereTranslationLike("name","%".request('name')."%");
            }
            if (request()->has('model') && !empty(request('model'))) {
                $lists->where('model', 'LIKE', '%'.request('model').'%');
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('category_id') && !is_null(request('category_id'))) {
                $lists->where('category_id', request('category_id'));
            }
            if (request()->has('brand_id') && !is_null(request('brand_id'))) {
                $lists->where('brand_id', request('brand_id'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();
        return view('admin.products.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('products.create')) {
            return abort(403);
        }
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();
        return view('admin.products.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('products.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('main_image') && $request->main_image != NULL) {
            $data['main_image']  = imageUpload($request->main_image, 'products');
        }
        $data['is_active']      = 1;
        $data['user_id']        = \Auth()->guard('admin')->user()->id;
        $product = Product::create($data);
        if (request()->has('images') && $request->images != NULL && count($request->images) != 0) {
            foreach(ProductImages::where('product_id', $product->id)->get() as $pro_image) {
                DeleteImage($pro_image->image);
                $pro_image->delete();
            }
            foreach ($request->images as $image) {
                ProductImages::create([
                    'product_id' => $product->id,
                    'image' => imageUpload($image, 'products/'.$product->id),
                ]);
            }
        }
        if(request()->has('options') && $request->options != NULL && count($request->options) != 0){
            ProductOptions::where('product_id', $product->id)->delete();
            foreach ($data['options']['ar_name'] as $key => $item) {
                if ($data['options']['ar_name'][$key] && $data['options']['ar_name'][$key] != '' && $data['options']['ar_name'][$key] != ' ' && $data['options']['en_name'][$key] && $data['options']['en_name'][$key] != '' && $data['options']['en_name'][$key] != ' ' && $data['options']['value'][$key] && $data['options']['value'][$key] != '' && $data['options']['value'][$key] != ' ') {
                    ProductOptions::create([
                        'product_id' => $product->id,
                        'ar_name' => $item,
                        'en_name' => $data['options']['en_name'][$key],
                        'value' => $data['options']['value'][$key]
                    ]);
                }
            }
        }
        return redirect()->route('app.products.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($product) {
        if (!permissionCheck('products.update')) {
            return abort(403);
        }
        $product = Product::find($product);
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();
        $options = $product->product_options;
        return view('admin.products.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $product) {
        if (!permissionCheck('products.update')) {
            return abort(403);
        }
        $product = Product::find($product);
        $data = $request->all();
        if (request()->has('main_image') && $request->main_image != NULL) {
            $data['main_image']      = imageUpload($request->main_image, 'products', [], false, true, $product->main_image);
        }else{
            unset($data['main_image']);
        }
        $product->update($data);
        if (request()->has('images') && $request->images != NULL && count($request->images) != 0) {
            foreach($product->product_images as $pro_image) {
                DeleteImage($pro_image->image);
                $pro_image->delete();
            }
            foreach ($request->images as $image) {
                ProductImages::create([
                    'product_id' => $product->id,
                    'image' => imageUpload($image, 'products/'.$product->id),
                ]);
            }
        }
        if(request()->has('options') && $request->options != NULL && count($request->options) != 0){
            ProductOptions::where('product_id', $product->id)->delete();
            foreach ($data['options']['ar_name'] as $key => $item) {
                if ($data['options']['ar_name'][$key] && $data['options']['ar_name'][$key] != '' && $data['options']['ar_name'][$key] != ' ' && $data['options']['en_name'][$key] && $data['options']['en_name'][$key] != '' && $data['options']['en_name'][$key] != ' ' && $data['options']['value'][$key] && $data['options']['value'][$key] != '' && $data['options']['value'][$key] != ' ') {
                    ProductOptions::create([
                        'product_id' => $product->id,
                        'ar_name' => $item,
                        'en_name' => $data['options']['en_name'][$key],
                        'value' => $data['options']['value'][$key]
                    ]);
                }
            }
        }
        return redirect()->route('app.products.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($product) {
        if (!permissionCheck('products.delete')) {
            return abort(403);
        }
        $product = Product::find($product);
        DeleteImage($product->main_image);
        foreach($product->product_images as $pro_image) {
            DeleteImage($pro_image->image);
            $pro_image->delete();
        }
        $product->delete();
        return redirect()->route('app.products.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($product)
    {
        $product = Product::find($product);
        if ($product->is_active == 0) {
            $product->update(['is_active' => 1]);
        }else{
            $product->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_main_image($product) {
        $product = Product::find($product);
        DeleteImage($product->main_image);
        $product->update([
            'main_image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }

    public function remove_images($product_image) {
        $product_image = ProductImages::find($product_image);
        DeleteImage($product_image->image);
        $product_image->delete();
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
