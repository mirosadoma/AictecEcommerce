<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\User;
// Requests
use App\Http\Requests\Dashboard\Companies\StoreRequest;
use App\Http\Requests\Dashboard\Companies\UpdateRequest;

class CompaniesController extends Controller {

    public function index() {
        if (!permissionCheck('companies.view')) {
            return abort(403);
        }
        $lists = User::query()->where('type', 'company')->where('id', '<>', 1);
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->where('name', 'LIKE', '%'.request('name').'%');
            }
            if (request()->has('company_name') && !empty(request('company_name'))) {
                $lists->where('company_name', 'LIKE', '%'.request('company_name').'%');
            }
            if (request()->has('email') && !empty(request('email'))) {
                $lists->where('email', 'LIKE', '%'.request('email').'%');
            }
            if (request()->has('phone') && !empty(request('phone'))) {
                $lists->where('phone', 'LIKE', '%'.request('phone').'%');
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
            $lists = $lists->orderBy('id', "DESC")->paginate();
        }elseif(request()->has('type')) {
            if (request('type') == "active") {
                $lists = $lists->where('is_active', 1)->orderBy('id', "DESC")->paginate()->appends(['type' => 'active']);
            }else if(request('type') == "unactive"){
                $lists = $lists->where('is_active', 0)->orderBy('id', "DESC")->paginate()->appends(['type' => 'unactive']);
            }else if(request('type') == "deleted"){
                $lists = $lists->onlyTrashed()->orderBy('id', "DESC")->paginate()->appends(['type' => 'deleted']);
            }else{
                $lists = $lists->orderBy('id', "DESC")->paginate();
            }
        }else{
            $lists = $lists->orderBy('id', "DESC")->paginate();
        }
        return view('admin.companies.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('companies.create')) {
            return abort(403);
        }
        return view('admin.companies.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('companies.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']  = imageUpload($request->image, 'companies');
        }
        $data['password']   = bcrypt($request->password);
        $data['type']       = 'company';
        $data['is_active']  = 1;
        $company              = User::create($data);
        if (request()->has('role_name')) {
            $company->syncRoles($request->role_name);
        }
        return redirect()->route('app.companies.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($company) {
        if (\Auth::guard('admin')->user()->id != $company) {
            if (!permissionCheck('companies.update')) {
                return abort(403);
            }
        }
        $company = User::where('type', 'company')->withTrashed()->find($company);
        return view('admin.companies.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $company) {
        if (\Auth::guard('admin')->user()->id != $company) {
            if (!permissionCheck('companies.update')) {
                return abort(403);
            }
        }
        $company = User::where('type', 'company')->withTrashed()->find($company);
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']      = imageUpload($request->image, 'companies', [], false, true, $company->image);
        }else{
            unset($data['image']);
        }
        if ($request->has("password") && !is_null($request->password)) {
            $data['password']   = bcrypt($request->password);
        }else{
            unset($data['password']);
        }
        $data['type']           = 'company';
        $company->update($data);
        return redirect()->route('app.companies.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($company) {
        if (!permissionCheck('companies.delete')) {
            return abort(403);
        }
        $company = User::where('type', 'company')->withTrashed()->find($company);
        $company->delete();
        return redirect()->route('app.companies.index')->with('success', __('Data Deleted Successfully'));
    }

    public function deleteForever($company) {
        if (!permissionCheck('companies.delete')) {
            return abort(403);
        }
        $company = User::where('type', 'company')->withTrashed()->find($company);
        DeleteImage($company->image);
        $company->forceDelete();
        return redirect()->back()->with('success', __('Data Deleted Forever Successfully'));
    }

    public function restore($company) {
        if (!permissionCheck('companies.delete')) {
            return abort(403);
        }
        $company = User::where('type', 'company')->withTrashed()->find($company);
        $company->restore();
        return redirect()->back()->with('success', __('Data Restore Successfully'));
    }

    public function is_active($company)
    {
        $company = User::where('type', 'company')->withTrashed()->find($company);
        if ($company->is_active == 0) {
            $company->update(['is_active' => 1]);
        }else{
            $company->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_image($company) {
        $company = User::where('type', 'company')->withTrashed()->find($company);
        DeleteImage($company->image);
        $company->update([
            'image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
