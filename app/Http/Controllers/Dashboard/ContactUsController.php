<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactUsExport;
use App\Jobs\ReplyJob;
// Models
use App\Models\ContactUs\ContactUs;
use Carbon\Carbon;
use Auth;
// Requests
use App\Http\Requests\Dashboard\ContactUs\UpdateRequest;

class ContactUsController extends Controller {

    public function index() {
        if (!permissionCheck('contact_us.view')) {
            return abort(403);
        }
        $lists = ContactUs::query();
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
        return view('admin.contact_us.index',get_defined_vars());
    }

    public function show($contact_us) {
        if (!permissionCheck('contact_us.view')) {
            return abort(403);
        }
        $contact_us = ContactUs::find($contact_us);
        return view('admin.contact_us.show',get_defined_vars());
    }

    public function update(UpdateRequest $request, $contact_us) {
        if (!permissionCheck('contact_us.update')) {
            return abort(403);
        }
        $contact_us = ContactUs::find($contact_us);
        $contact_us->update([
            'reply'             => $request->reply,
            'reply_owner_id'    => Auth::guard('admin')->user()->id,
            'reply_date'        => Carbon::now()
        ]);
        // mail
        $data['user_name'] = $contact_us->name;
        $data['user_email'] = $contact_us->email;
        $data['project_name'] = __("Aictec Ecommerce");
        $data['welcome_msg'] = __("Welcome");
        $data['project_link'] = env('APP_URL', 'https://www.aictec.com/');
        $data['reply'] = $request->reply;
        dispatch(new ReplyJob($data, $contact_us));
        return redirect()->back()->with('success', __('The contact has been answered successfully'));
    }

    public function destroy($contact_us) {
        if (!permissionCheck('contact_us.delete')) {
            return abort(403);
        }
        $contact_us = ContactUs::find($contact_us);
        $contact_us->delete();
        return redirect()->route('app.contactus.index')->with('success', __('Data Deleted Successfully'));
    }

    public function export()
    {
        return Excel::download(new ContactUsExport, 'contact_us.xlsx');
    }
}
