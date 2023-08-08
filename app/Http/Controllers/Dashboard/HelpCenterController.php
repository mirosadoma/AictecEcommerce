<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\HelpCenter\HelpCenter;
// Requests
use App\Http\Requests\Dashboard\HelpCenter\StoreRequest;
use App\Http\Requests\Dashboard\HelpCenter\UpdateRequest;

class HelpCenterController extends Controller {

    public function index() {
        if (!permissionCheck('help_center.view')) {
            return abort(403);
        }
        $lists = HelpCenter::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('help_center') && !empty(request('help_center'))) {
                $lists->whereTranslationLike("help_center","%".request('help_center')."%");
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.help_center.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('help_center.create')) {
            return abort(403);
        }
        return view('admin.help_center.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('help_center.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['is_active']      = 1;
        HelpCenter::create($data);
        return redirect()->route('app.help_center.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($help_center) {
        if (!permissionCheck('help_center.update')) {
            return abort(403);
        }
        $help_center = HelpCenter::find($help_center);
        return view('admin.help_center.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $help_center) {
        if (!permissionCheck('help_center.update')) {
            return abort(403);
        }
        $help_center = HelpCenter::find($help_center);
        $help_center->update($request->all());
        return redirect()->route('app.help_center.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($help_center) {
        if (!permissionCheck('help_center.delete')) {
            return abort(403);
        }
        $help_center = HelpCenter::find($help_center);
        $help_center->delete();
        return redirect()->route('app.help_center.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($help_center)
    {
        $help_center = HelpCenter::find($help_center);
        if ($help_center->is_active == 0) {
            $help_center->update(['is_active' => 1]);
        }else{
            $help_center->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }
}
