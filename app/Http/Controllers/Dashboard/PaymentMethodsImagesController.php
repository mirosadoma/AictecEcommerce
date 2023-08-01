<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\PaymentMethodsImages\PaymentMethodsImage;
// Requests
use App\Http\Requests\Dashboard\PaymentMethodsImages\StoreRequest;
use App\Http\Requests\Dashboard\PaymentMethodsImages\UpdateRequest;

class PaymentMethodsImagesController extends Controller {

    public function index() {
        if (!permissionCheck('payment_methods_images.view')) {
            return abort(403);
        }
        $lists = PaymentMethodsImage::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.payment_methods_images.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('payment_methods_images.create')) {
            return abort(403);
        }
        return view('admin.payment_methods_images.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('payment_methods_images.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']  = imageUpload($request->image, 'payment_methods_images', [50,50]);
        }
        $data['is_active']  = 1;
        PaymentMethodsImage::create($data);
        return redirect()->route('app.payment_methods_images.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($payment_methods_image) {
        if (!permissionCheck('payment_methods_images.update')) {
            return abort(403);
        }
        $payment_methods_image = PaymentMethodsImage::find($payment_methods_image);
        return view('admin.payment_methods_images.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $payment_methods_image) {
        if (!permissionCheck('payment_methods_images.update')) {
            return abort(403);
        }
        $payment_methods_image = PaymentMethodsImage::find($payment_methods_image);
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']      = imageUpload($request->image, 'payment_methods_images', [50,50], false, true, $payment_methods_image->image);
        }else{
            unset($data['image']);
        }
        $payment_methods_image->update($data);
        return redirect()->route('app.payment_methods_images.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($payment_methods_image) {
        if (!permissionCheck('payment_methods_images.delete')) {
            return abort(403);
        }
        $payment_methods_image = PaymentMethodsImage::find($payment_methods_image);
        DeleteImage($payment_methods_image->image);
        $payment_methods_image->delete();
        return redirect()->route('app.payment_methods_images.index')->with('success', __('Data Deleted Successfully'));
    }

    public function is_active($payment_methods_image)
    {
        $payment_methods_image = PaymentMethodsImage::find($payment_methods_image);
        if ($payment_methods_image->is_active == 0) {
            $payment_methods_image->update(['is_active' => 1]);
        }else{
            $payment_methods_image->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_image($payment_methods_image) {
        $payment_methods_image = PaymentMethodsImage::find($payment_methods_image);
        DeleteImage($payment_methods_image->image);
        $payment_methods_image->update([
            'image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
