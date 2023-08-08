<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\EmailJob;
use App\Jobs\SMSJob;
// Models
use App\Models\Emails\Email as ClientEmail;
use App\Models\User;
// Requests
use App\Http\Requests\Dashboard\Emails\StoreRequest;
use App\Support\SMS;
use Illuminate\Support\Facades\Log;

class EmailsController extends Controller {

    public function index() {
        if (!permissionCheck('emails.view')) {
            return abort(403);
        }
        $lists = ClientEmail::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('title') && !empty(request('title'))) {
                $lists->whereTranslationLike("title","%".request('title')."%");
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.emails.index',get_defined_vars());
    }

    public function send() {
        if (!permissionCheck('emails.send')) {
            return abort(403);
        }
        $all_clients = User::where('type', 'client')->get();
        return view('admin.emails.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('emails.send')) {
            return abort(403);
        }
        if ($request->email_clients_type == "all_clients") {
            $clients = User::where('type', 'client')->get();
            foreach ($clients as $client) {
                ClientEmail::create([
                    'content' => $request->content,
                    'user_id' => $client->id,
                ]);
                if (in_array('sms',$request->email_type)) {
                    // SMS
                    dispatch(new SMSJob($client, $request->content));
                }
                if (in_array('email',$request->email_type)) {
                    // Email
                    $data['user_name'] = $client->name;
                    $data['user_email'] = $client->email;
                    $data['project_name'] = __("Aictec Ecommerce");
                    $data['welcome_msg'] = __("Welcome");
                    $data['project_link'] = env('APP_URL', 'https://www.aictec.com/');
                    $data['content'] = $request->content;
                    dispatch(new EmailJob($data, $client));
                }
            }
        } elseif($request->email_clients_type == "one_client") {
            $clients = User::whereIn('id', $request->clients)->where('type', 'client')->get();
            foreach ($clients as $client) {
                ClientEmail::create([
                    'content' => $request->content,
                    'user_id' => $client->id,
                ]);
                if (in_array('sms',$request->email_type)) {
                    // SMS
                    dispatch(new SMSJob($client, $request->content));
                }
                if (in_array('email',$request->email_type)) {
                    // Email
                    $data['user_name'] = $client->name;
                    $data['user_email'] = $client->email;
                    $data['project_name'] = __("Aictec Ecommerce");
                    $data['welcome_msg'] = __("Welcome");
                    $data['project_link'] = env('APP_URL', 'https://www.aictec.com/');
                    $data['content'] = $request->content;
                    dispatch(new EmailJob($data, $client));
                }
            }
        }
        return redirect()->route('app.emails.index')->with('success', __('Data Saved Successfully'));
    }

    public function destroy($list) {
        if (!permissionCheck('emails.delete')) {
            return abort(403);
        }
        $list = ClientEmail::find($list);
        $list->delete();
        return redirect()->route('app.emails.index')->with('success', __('Data Deleted Successfully'));
    }
}
