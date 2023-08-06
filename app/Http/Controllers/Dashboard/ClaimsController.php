<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClaimsExport;
// Models
use App\Models\Claims\Claim;
use App\Jobs\ReplyJob;
use Carbon\Carbon;
use Auth;
// Requests
use App\Http\Requests\Dashboard\Claims\UpdateRequest;

class ClaimsController extends Controller {

    public function index() {
        if (!permissionCheck('claims.view')) {
            return abort(403);
        }
        $lists = Claim::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->where('name', 'LIKE', '%'.request('name').'%');
            }
            if (request()->has('email') && !empty(request('email'))) {
                $lists->where('email', 'LIKE', '%'.request('email').'%');
            }
            if (request()->has('phone') && !empty(request('phone'))) {
                $lists->where('phone', 'LIKE', '%'.request('phone').'%');
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.claims.index',get_defined_vars());
    }

    public function show($claim) {
        if (!permissionCheck('claims.view')) {
            return abort(403);
        }
        $claim = Claim::find($claim);
        return view('admin.claims.show',get_defined_vars());
    }

    public function update(UpdateRequest $request, $claim) {
        if (!permissionCheck('claims.update')) {
            return abort(403);
        }
        $claim = Claim::find($claim);
        $claim->update([
            'reply'             => $request->reply,
            'reply_owner_id'    => Auth::guard('admin')->user()->id,
            'reply_date'        => Carbon::now()
        ]);
        // mail
        $data['user_name'] = $claim->name;
        $data['user_email'] = $claim->email;
        $data['project_name'] = __("Aictec Ecommerce");
        $data['welcome_msg'] = __("Welcome");
        $data['project_link'] = env('APP_URL', 'https://www.aictec.com/');
        $data['reply'] = $request->reply;
        dispatch(new ReplyJob($data, $claim));
        return redirect()->back()->with('success', __('The contact has been answered successfully'));
    }

    public function destroy($claim) {
        if (!permissionCheck('claims.delete')) {
            return abort(403);
        }
        $claim = Claim::find($claim);
        $claim->delete();
        return redirect()->route('app.claims.index')->with('success', __('Data Deleted Successfully'));
    }

    public function export()
    {
        return Excel::download(new ClaimsExport, 'claims.xlsx');
    }
}
