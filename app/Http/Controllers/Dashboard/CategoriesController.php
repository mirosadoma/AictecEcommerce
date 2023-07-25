<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Categories\Category;
// Requests
use App\Http\Requests\Dashboard\Categories\StoreRequest;
use App\Http\Requests\Dashboard\Categories\UpdateRequest;

class CategoriesController extends Controller {

    public function index() {
        if (!permissionCheck('categories.view')) {
            return abort(403);
        }
        $lists = Category::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->whereTranslationLike("name","%".request('name')."%");
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.categories.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('categories.create')) {
            return abort(403);
        }
        return view('admin.categories.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('categories.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']  = imageUpload($request->image, 'categories');
        }
        $data['is_active']      = 1;
        Category::create($data);
        return redirect()->route('app.categories.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($category) {
        if (!permissionCheck('categories.update')) {
            return abort(403);
        }
        $category = Category::find($category);
        return view('admin.categories.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $category) {
        if (!permissionCheck('categories.update')) {
            return abort(403);
        }
        $category = Category::find($category);
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']      = imageUpload($request->image, 'categories', [], false, true, $category->image);
        }else{
            unset($data['image']);
        }
        $category->update($data);
        return redirect()->route('app.categories.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($category) {
        if (!permissionCheck('categories.delete')) {
            return abort(403);
        }
        $category = Category::find($category);
        DeleteImage($category->image);
        $category->delete();
        return redirect()->route('app.categories.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($category)
    {
        $category = Category::find($category);
        if ($category->is_active == 0) {
            $category->update(['is_active' => 1]);
        }else{
            $category->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_image($category) {
        $category = Category::find($category);
        DeleteImage($category->image);
        $category->update([
            'image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
