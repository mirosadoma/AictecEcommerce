<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\ShippingCompanies\ShippingCompany;
// Requests
use App\Http\Requests\Dashboard\ShippingCompanies\StoreRequest;
use App\Http\Requests\Dashboard\ShippingCompanies\UpdateRequest;

class ShippingCompaniesController extends Controller {

    public function index() {
        if (!permissionCheck('shipping_companies.view')) {
            return abort(403);
        }
        $lists = ShippingCompany::query();
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
        return view('admin.shipping_companies.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('shipping_companies.create')) {
            return abort(403);
        }
        return view('admin.shipping_companies.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('shipping_companies.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['is_active']      = 1;
        ShippingCompany::create($data);
        return redirect()->route('app.shipping_companies.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($shipping_company) {
        if (!permissionCheck('shipping_companies.update')) {
            return abort(403);
        }
        $shipping_company = ShippingCompany::find($shipping_company);
        return view('admin.shipping_companies.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $shipping_company) {
        if (!permissionCheck('shipping_companies.update')) {
            return abort(403);
        }
        $shipping_company = ShippingCompany::find($shipping_company);
        $data = $request->all();
        $shipping_company->update($data);
        return redirect()->route('app.shipping_companies.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($shipping_company) {
        if (!permissionCheck('shipping_companies.delete')) {
            return abort(403);
        }
        $shipping_company = ShippingCompany::find($shipping_company);
        DeleteImage($shipping_company->image);
        $shipping_company->delete();
        return redirect()->route('app.shipping_companies.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($shipping_company)
    {
        $shipping_company = ShippingCompany::find($shipping_company);
        if ($shipping_company->is_active == 0) {
            $shipping_company->update(['is_active' => 1]);
        }else{
            $shipping_company->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }
}
