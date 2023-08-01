<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Cities\City;
// Requests
use App\Http\Requests\Dashboard\Cities\StoreRequest;
use App\Http\Requests\Dashboard\Cities\UpdateRequest;

class CitiesController extends Controller {

    public function index() {
        if (!permissionCheck('cities.view')) {
            return abort(403);
        }
        $lists = City::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->whereTranslationLike("name","%".request('name')."%");
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.cities.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('cities.create')) {
            return abort(403);
        }
        return view('admin.cities.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('cities.create')) {
            return abort(403);
        }
        City::create($request->all());
        return redirect()->route('app.cities.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($city) {
        if (!permissionCheck('cities.update')) {
            return abort(403);
        }
        $city = City::find($city);
        return view('admin.cities.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $city) {
        if (!permissionCheck('cities.update')) {
            return abort(403);
        }
        $city = City::find($city);
        $city->update($request->all());
        return redirect()->route('app.cities.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($city) {
        if (!permissionCheck('cities.delete')) {
            return abort(403);
        }
        $city = City::find($city);
        if ($city->districts->count()) {
            return redirect()->back()->with('error', __('You cannot delete this city'));
        }
        $city->delete();
        return redirect()->route('app.cities.index')->with('success', __('Data Deleted Successfully'));
    }
}
