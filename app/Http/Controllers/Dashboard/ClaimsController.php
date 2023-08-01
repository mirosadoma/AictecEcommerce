<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Claims\Claim;
use Mail;
use App\Mail\SendReply;
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
        // $data['user_name'] = $claim->name;
        // $data['logo'] = asset(app_settings()->logo ?? 'webSite/images/Component 20 – 11.png');
        // $data['reply'] = $request->reply;
        // try {
        //     // hint send code to mail
        //     Mail::to($claim->email, $claim->name)->send(new SendReply($data));
        // }catch (\Exception $e){
        //     return $e->getMessage();
        // }
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
}
