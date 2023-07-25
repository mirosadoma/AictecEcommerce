<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Banners\Banner;
// Requests
use App\Http\Requests\Dashboard\Banners\StoreRequest;
use App\Http\Requests\Dashboard\Banners\UpdateRequest;

class BannersController extends Controller {

    public function index() {
        if (!permissionCheck('banners.view')) {
            return abort(403);
        }
        $lists = Banner::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('link') && !empty(request('link'))) {
                $lists->where('link', 'LIKE', '%'.request('link').'%');
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.banners.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('banners.create')) {
            return abort(403);
        }
        return view('admin.banners.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('banners.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']  = imageUpload($request->image, 'banners');
        }
        $data['is_active']      = 1;
        Banner::create($data);
        return redirect()->route('app.banners.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($banner) {
        if (!permissionCheck('banners.update')) {
            return abort(403);
        }
        $banner = Banner::find($banner);
        return view('admin.banners.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $banner) {
        if (!permissionCheck('banners.update')) {
            return abort(403);
        }
        $banner = Banner::find($banner);
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']      = imageUpload($request->image, 'banners', [], false, true, $banner->image);
        }else{
            unset($data['image']);
        }
        $banner->update($data);
        return redirect()->route('app.banners.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($banner) {
        if (!permissionCheck('banners.delete')) {
            return abort(403);
        }
        $banner = Banner::find($banner);
        DeleteImage($banner->image);
        $banner->delete();
        return redirect()->route('app.banners.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($banner)
    {
        $banner = Banner::find($banner);
        if ($banner->is_active == 0) {
            $banner->update(['is_active' => 1]);
        }else{
            $banner->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_image($banner) {
        $banner = Banner::find($banner);
        DeleteImage($banner->image);
        $banner->update([
            'image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
