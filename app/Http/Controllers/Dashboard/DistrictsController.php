<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Districts\District;
use App\Models\Cities\City;
// Requests
use App\Http\Requests\Dashboard\Districts\StoreRequest;
use App\Http\Requests\Dashboard\Districts\UpdateRequest;

class DistrictsController extends Controller {

    public function index() {
        if (!permissionCheck('districts.view')) {
            return abort(403);
        }
        $lists = District::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->whereTranslationLike("name", "%".request('name')."%");
            }
            if (request()->has('city_id') && !empty(request('city_id'))) {
                $lists->where("city_id", request('city_id'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        $cities = City::orderBy('id', "DESC")->get();
        return view('admin.districts.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('districts.create')) {
            return abort(403);
        }
        $cities = City::orderBy('id', "DESC")->get();
        return view('admin.districts.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('districts.create')) {
            return abort(403);
        }
        District::create($request->all());
        return redirect()->route('app.districts.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($district) {
        if (!permissionCheck('districts.update')) {
            return abort(403);
        }
        $district = District::find($district);
        $cities = City::orderBy('id', "DESC")->get();
        return view('admin.districts.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $district) {
        if (!permissionCheck('districts.update')) {
            return abort(403);
        }
        $district = District::find($district);
        $district->update($request->all());
        return redirect()->route('app.districts.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($district) {
        if (!permissionCheck('districts.delete')) {
            return abort(403);
        }
        $district = District::find($district);
        $district->delete();
        return redirect()->route('app.districts.index')->with('success', __('Data Deleted Successfully'));
    }
}
