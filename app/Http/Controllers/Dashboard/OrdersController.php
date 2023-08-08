<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Support\CreatePdfFile;
use Illuminate\Http\Request;
// Models
use App\Models\Orders\Order;
use App\Models\Cities\City;

// use App\Models\Notifications\AccountNotification;
// use Notification;
// use App\Models\Token;

use App\Exports\OrdersExport;
use App\Jobs\EmailJob;
use App\Jobs\SMSJob;
use App\Models\Districts\District;
use Maatwebsite\Excel\Facades\Excel;

class OrdersController extends Controller {

    public function index() {
        if (!permissionCheck('orders.view')) {
            return abort(403);
        }
        $lists = Order::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('user') && !empty(request('user'))) {
                $lists->whereHas('user', function ($q) {
                    return $q->where('name', 'LIKE', "%".request('user')."%");
                });
            }
            if (request()->has('status') && !is_null(request('status'))) {
                $lists->where('status', request('status'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
            if (request()->has('city_id') && !empty(request('city_id'))) {
                $lists = $lists->whereHas('address', function($query) {
                    $query->whereHas('city', function($q) {
                        return $q->where('city_id', request('city_id'));
                    });
                });
            }
            if (request()->has('district_id') && !empty(request('district_id'))) {
                $lists = $lists->whereHas('address', function($query) {
                    $query->whereHas('district', function($q) {
                        return $q->where('district_id', request('district_id'));
                    });
                });
            }
        }

        $cities = City::orderBy('id', "DESC")->get();
        $districts = District::orderBy('id', "DESC")->get();
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.orders.index',get_defined_vars());
    }

    public function show($order)
    {
        $order = Order::where('id', $order)->first();
        if (!$order) {
            abort(404);
        }
        return view('admin.orders.show', get_defined_vars());
    }

    public function order_change_status() {

        $order = Order::find(request('order_id'));
        if (request('status') == Order::STATUS_PAYMENTPENDDING) {
            $order->update(['status'=>request('status')]);
        }elseif (request('status') == Order::STATUS_PAID) {
            if (in_array($order->status, [Order::STATUS_IN_PROCESS,Order::STATUS_ASSIGNED,Order::STATUS_DELIVERED,Order::STATUS_CANCELLED])) {
                return [
                    'status'    => false,
                    'msg'       => __("You Can't Change Order Status To This Status"),
                ];
            }
            $order->update(['status'=>request('status')]);
        }elseif (request('status') == Order::STATUS_IN_PROCESS){
            if (in_array($order->status, [Order::STATUS_ASSIGNED,Order::STATUS_DELIVERED,Order::STATUS_CANCELLED])) {
                return [
                    'status'    => false,
                    'msg'       => __("You Can't Change Order Status To This Status"),
                ];
            }
            $order->update(['status'=>request('status')]);
            $ar_msg = '
                تغيير الحالة :
                طلبك الآن تحت المعالجة
            ';
            $en_msg = '
                Status change :
                Your request is now being processed
            ';
            $msg_send = check_locale($ar_msg , $en_msg);
            // SMS
            dispatch(new SMSJob($order->user, $msg_send));
            // Email
            $data['user_name'] = $order->user->name;
            $data['user_email'] = $order->user->email;
            $data['project_name'] = __("Aictec Ecommerce");
            $data['welcome_msg'] = __("Welcome");
            $data['project_link'] = env('APP_URL', 'https://www.aictec.com/');
            $data['content'] = $msg_send;
            dispatch(new EmailJob($data, $order->user));
        }elseif (request('status') == Order::STATUS_ASSIGNED){
            if (in_array($order->status, [Order::STATUS_DELIVERED,Order::STATUS_CANCELLED])) {
                return [
                    'status'    => false,
                    'msg'       => __("You Can't Change Order Status To This Status"),
                ];
            }
            $order->update(['status'=>request('status')]);
            $ar_msg = '
                تغيير الحالة :
                طلبك الآن تم إستلامه من قبل شركة الشحن
            ';
            $en_msg = '
                Status change :
                Your order has now been received by the shipping company
            ';
            $msg_send = check_locale($ar_msg , $en_msg);
            // SMS
            dispatch(new SMSJob($order->user, $msg_send));
            // Email
            $data['user_name'] = $order->user->name;
            $data['user_email'] = $order->user->email;
            $data['project_name'] = __("Aictec Ecommerce");
            $data['welcome_msg'] = __("Welcome");
            $data['project_link'] = env('APP_URL', 'https://www.aictec.com/');
            $data['content'] = $msg_send;
            dispatch(new EmailJob($data, $order->user));
        }elseif (request('status') == Order::STATUS_DELIVERED){
            if (in_array($order->status, [Order::STATUS_CANCELLED])) {
                return [
                    'status'    => false,
                    'msg'       => __("You Can't Change Order Status To This Status"),
                ];
            }
            $order->update(['status'=>request('status')]);
            $ar_msg = '
                تغيير الحالة :
                طلبك الآن تم توصيله
            ';
            $en_msg = '
                Status change :
                Your order has now been delivered
            ';
            $msg_send = check_locale($ar_msg , $en_msg);
            // SMS
            dispatch(new SMSJob($order->user, $msg_send));
            // Email
            $data['user_name'] = $order->user->name;
            $data['user_email'] = $order->user->email;
            $data['project_name'] = __("Aictec Ecommerce");
            $data['welcome_msg'] = __("Welcome");
            $data['project_link'] = env('APP_URL', 'https://www.aictec.com/');
            $data['content'] = $msg_send;
            dispatch(new EmailJob($data, $order->user));
        }elseif (request('status') == Order::STATUS_CANCELLED){
            $order->update(['status'=>request('status')]);
            $ar_msg = '
                تغيير الحالة :
                تم إلغاء طلبك
            ';
            $en_msg = '
                Status change :
                Your order has been cancelled
            ';
            $msg_send = check_locale($ar_msg , $en_msg);
            // SMS
            dispatch(new SMSJob($order->user, $msg_send));
            // Email
            $data['user_name'] = $order->user->name;
            $data['user_email'] = $order->user->email;
            $data['project_name'] = __("Aictec Ecommerce");
            $data['welcome_msg'] = __("Welcome");
            $data['project_link'] = env('APP_URL', 'https://www.aictec.com/');
            $data['content'] = $msg_send;
            dispatch(new EmailJob($data, $order->user));
        }
        return [
            'status'    => true,
            'msg'       => __('Change Status Done'),
        ];
    }
    public function orders_export() {
        return Excel::download(new OrdersExport(), 'orders.xlsx');
    }

    public function order_print(Order $order) {
        return view('admin.orders.print', get_defined_vars());
    }

    public function order_export_pdf($order) {
        $order = Order::find($order);
        $html = view('admin.orders.print', get_defined_vars())->render();
        // $pdf = (new CreatePdfFile())->getPdf($html)->setWaterMark(app_settings()->logo_path);
        $pdf = (new CreatePdfFile())->getPdf($html);
        return $order ? response($pdf->output('orders.pdf', "D"), 200, ['Content-Type', 'application/pdf']) : redirect()->back()->with('error', __('No Data Founded'))->withInput();
    }
}
