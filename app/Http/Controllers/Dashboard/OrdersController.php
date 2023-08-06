<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Orders\Order;
use App\Models\Cities\City;

// use App\Models\Notifications\AccountNotification;
// use Notification;
// use App\Models\Token;

use App\Exports\OrdersExport;
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

    public function changeStatus() {

        $order = Order::find(request('order_id'));
        dd($order);
        $order->status = request('status');
        $order->save();
        // $tokens = Token::where('user_id', $order->user->id)->pluck('device_token')->toArray();
        //push notification
        // $data = [
        //     'title'         => "",
        //     'message'       => __("order status changed"),
        //     'type'          => "orders",
        //     'element_id'    => $order->id
        // ];
        // push_send($tokens, $data);
        // $notify_ar = "تم تغيير حالة الطلب";
        // $notify_en = 'order status changed';
        // Notification::send($order->user , new AccountNotification($notify_ar ,$notify_en , 'orders' , $order->id));
        // $msg = api_msg(request() , $notify_ar ,$notify_en);
        return [
            'status' => true,
        ];
    }

    public function orders_export() {
        return Excel::download(new OrdersExport(), 'orders.xlsx');
    }

    // public function order_print(Order $order) {
    //     dd($order);
    //     return view('admin.orders.print', get_defined_vars());
    // }

    // public function order_details_print($id){
    //     $order = Order::find($id);
    //     if ($order->driver_id) {
    //         $drivers = Driver::where("is_active", "yes")->orWhere("id", (int) $order->driver_id)->orderBy("arabic_name")->get();
    //     }else{
    //         $drivers = Driver::where("is_active", "yes")->orderBy("arabic_name")->get();
    //     }
    //     $title = "";
    //     $order_phone = app('settings')->order_phone;
    //     $tax_percentage = app('settings')->tax;
    //     $generatedString = GenerateQrCode::fromArray([
    //         new Seller(app('settings')->invoice_app_company_name), // seller name
    //         new TaxNumber(app('settings')->invoice_app_tax_no), // seller tax number
    //         new InvoiceDate($order->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
    //         new InvoiceTotalAmount($order->final_total), // invoice total amount
    //         new InvoiceTaxAmount( $order->tax_total) // invoice tax amount
    //         // TODO :: Support others tags
    //     ])->render();
    //     return view('admin.order.invoice', get_defined_vars());
    // }
}
