<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Banks\Bank;
// Requests
use App\Http\Requests\Dashboard\Banks\StoreRequest;
use App\Http\Requests\Dashboard\Banks\UpdateRequest;

class BanksController extends Controller {

    public function index() {
        if (!permissionCheck('banks.view')) {
            return abort(403);
        }
        $lists = Bank::query();
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
        return view('admin.banks.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('banks.create')) {
            return abort(403);
        }
        return view('admin.banks.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('banks.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['is_active']      = 1;
        Bank::create($data);
        return redirect()->route('app.banks.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($bank) {
        if (!permissionCheck('banks.update')) {
            return abort(403);
        }
        $bank = Bank::find($bank);
        return view('admin.banks.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $bank) {
        if (!permissionCheck('banks.update')) {
            return abort(403);
        }
        $bank = Bank::find($bank);
        $data = $request->all();
        $bank->update($data);
        return redirect()->route('app.banks.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($bank) {
        if (!permissionCheck('banks.delete')) {
            return abort(403);
        }
        $bank = Bank::find($bank);
        DeleteImage($bank->image);
        $bank->delete();
        return redirect()->route('app.banks.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($bank)
    {
        $bank = Bank::find($bank);
        if ($bank->is_active == 0) {
            $bank->update(['is_active' => 1]);
        }else{
            $bank->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }
}
