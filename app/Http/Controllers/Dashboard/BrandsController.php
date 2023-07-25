<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Brands\Brand;
// Requests
use App\Http\Requests\Dashboard\Brands\StoreRequest;
use App\Http\Requests\Dashboard\Brands\UpdateRequest;

class BrandsController extends Controller {

    public function index() {
        if (!permissionCheck('brands.view')) {
            return abort(403);
        }
        $lists = Brand::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->where('name', 'LIKE', '%'.request('name').'%');
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.brands.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('brands.create')) {
            return abort(403);
        }
        return view('admin.brands.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('brands.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']  = imageUpload($request->image, 'brands');
        }
        $data['is_active']      = 1;
        Brand::create($data);
        return redirect()->route('app.brands.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($brand) {
        if (!permissionCheck('brands.update')) {
            return abort(403);
        }
        $brand = Brand::find($brand);
        return view('admin.brands.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $brand) {
        if (!permissionCheck('brands.update')) {
            return abort(403);
        }
        $brand = Brand::find($brand);
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']      = imageUpload($request->image, 'brands', [], false, true, $brand->image);
        }else{
            unset($data['image']);
        }
        $brand->update($data);
        return redirect()->route('app.brands.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($brand) {
        if (!permissionCheck('brands.delete')) {
            return abort(403);
        }
        $brand = Brand::find($brand);
        DeleteImage($brand->image);
        $brand->delete();
        return redirect()->route('app.brands.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($brand)
    {
        $brand = Brand::find($brand);
        if ($brand->is_active == 0) {
            $brand->update(['is_active' => 1]);
        }else{
            $brand->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_image($brand) {
        $brand = Brand::find($brand);
        DeleteImage($brand->image);
        $brand->update([
            'image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
