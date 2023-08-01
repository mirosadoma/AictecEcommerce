<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Coupons\Coupon;
// Requests
use App\Http\Requests\Dashboard\Coupons\StoreRequest;
use App\Http\Requests\Dashboard\Coupons\UpdateRequest;

class CouponsController extends Controller {

    public function index() {
        if (!permissionCheck('coupons.view')) {
            return abort(403);
        }
        $lists = Coupon::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->whereTranslationLike("name","%".request('name')."%");
            }
            if (request()->has('start_date') && !empty(request('start_date'))) {
                $lists->whereDate('start_date', request('start_date'));
            }
            if (request()->has('end_date') && !empty(request('end_date'))) {
                $lists->whereDate('end_date', request('end_date'));
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.coupons.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('coupons.create')) {
            return abort(403);
        }
        return view('admin.coupons.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('coupons.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['is_active'] = 1;
        Coupon::create($data);
        return redirect()->route('app.coupons.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($coupon) {
        if (!permissionCheck('coupons.update')) {
            return abort(403);
        }
        $coupon = Coupon::find($coupon);
        return view('admin.coupons.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $coupon) {
        if (!permissionCheck('coupons.update')) {
            return abort(403);
        }
        $coupon = Coupon::find($coupon);
        $data = $request->all();
        $coupon->update($data);
        return redirect()->route('app.coupons.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($coupon) {
        if (!permissionCheck('coupons.delete')) {
            return abort(403);
        }
        $coupon = Coupon::find($coupon);
        DeleteImage($coupon->image);
        $coupon->delete();
        return redirect()->route('app.coupons.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($coupon)
    {
        $coupon = Coupon::find($coupon);
        if ($coupon->is_active == 0) {
            $coupon->update(['is_active' => 1]);
        }else{
            $coupon->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }
}
