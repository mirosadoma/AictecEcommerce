<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Requests
use App\Http\Requests\Api\Orders\CheckOutRequest;
// Resources
use App\Http\Resources\Api\CouponResources;
use App\Http\Resources\Api\OrdersResources;
use App\Models\Addressess\Address;
use App\Models\Coupons\Coupon;
// Models
use App\Models\Orders\Order;
use App\Models\Orders\OrderCoupons;
use App\Models\Products\Product;
use App\Models\Products\ProductLogs;
use App\Models\Products\ProductNotification;
use App\Models\WalletLogs;
use App\Support\API;
use App\Support\Urway;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller {

    public function check_coupon(Request $request){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        $coupon = Coupon::where('is_active', 1)->where('id', $request->coupon_id)->first();
        if (!$coupon) {
            return (new API)
                ->isError(__('Coupon Not Found'))
                ->build();
        }
        return (new API)
            ->isOk(__('Your Coupon Data'))
            ->setData(new CouponResources($coupon))
            ->build();
    }

    public function check_out(CheckOutRequest $request){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        // get settings
        $tax = app_settings()->tax;
        $delivery_charge = 0;
        $sub_total = 0;
        $discount = 0;
        $tax_total = 0;
        $grand_total = 0;

        // get coupon_id
        $apply_coupon = false;
        $coupon_row = null;
        if ($request->coupon_id && trim($request->coupon_id) != "") {
            $coupon_row = Coupon::where('start_date', '<=', today())
                ->where('end_date', '>=', today())
                ->where('id', $request->coupon_id)
                ->first();
        }

        $processed_products = [];
        foreach ($request->products as $product) {
            if (intval($product["quantity"]) > 0) {
                $prow = Product::find($product['product_id']);
                if ($prow) {
                    // if($prow->max_order_count < $product["quantity"]){
                    //     $errMessage = [
                    //         "en" => "Product: " . $prow->english_name. " Exceed Max Order Count.",
                    //         "ar" => "تعدي اقصي كميه للطلب " . $prow->english_name. " المنتج"
                    //     ];
                    //     return false;
                    // }
                    if(intval($product["quantity"]) > intval($prow->quantity)) {
                        return (new API)
                            ->isError(__('Quantity Not Available'))
                            ->build();
                    }
                    $processed_product = [];
                    $processed_product["id"] = $prow->id;
                    $processed_product["price"] = $prow->price;
                    $processed_product["quantity"] = intval($product["quantity"]);

                    // $base_price = ($prow->price * 100) / (100 + $tax);
                    // $item_tax = $prow->price - $base_price;

                    $item_tax = $prow->price * ($tax / 100);
                    $base_price = $prow->price;
                    $sub_total += ($product["quantity"] * $base_price);
                    $tax_total += ($product["quantity"] * $item_tax);

                    $processed_products[] = $processed_product;
                } else {
                    return (new API)
                        ->isError(__('Product Not Found'))
                        ->build();
                }
            }
        }
        $grand_total = $sub_total + $tax_total;

        if ($coupon_row) {
            // $customer_coupons_count = OrderCoupons::where('user_id',$user->id)->where('coupon_id', $coupon_row->id)->count();
            // if($customer_coupons_count){
            //     return (new API)
            //         ->isError(__('This coupon is used before'))
            //         ->build();
            // }
            if ($coupon_row->type == "amount") {
                $discount = $coupon_row->value;
            } else if($coupon_row->type == "percentage"){
                $discount = $grand_total * ($coupon_row->value / 100);
            }
            $apply_coupon = true;
        }
        // check if discount
        if ($discount > $grand_total) {
            $discount = $grand_total;
        }
        // check if address inside ryadh or out
        $address = Address::find($request->address_id);
        if ($address->id == 1) {
            $delivery_charge = app_settings()->delivery_charge;
        }else{
            // address outside ryadh
            $delivery_charge = 0;
        }
        $final_total = $grand_total + $delivery_charge - $discount;

        $payment_method = Null;
        $my_wallet = floatval($user->wallet);
        $used_wallet = 0;
        $payment_total = 0;
        $use_payment = false;

        if ($apply_coupon == true) {
            if ($final_total > 0) {
                $use_payment = true;
            }elseif ($final_total <= 0) {
                $use_payment = false;
            }
        }else{
            $use_payment = true;
        }

        if ($use_payment == true) {
            // check if wallet or discount found
            if ($request->wallet_used == true) {
                if ($my_wallet <= 0) {
                    return (new API)
                        ->isError(__('Wallet Is Empty'))
                        ->build();
                }elseif($final_total > $my_wallet){
                    if($request->payment_method_used == false){
                        return (new API)
                            ->isError(__('The amount is not available. Please complete another payment method'))
                            ->build();
                    }
                    $used_wallet = $my_wallet;
                    $payment_method = $request->payment_method;
                }elseif($final_total < $my_wallet){
                    $used_wallet = $final_total;
                    $payment_method = 'Wallet';
                }
            }else {
                if($request->payment_method_used == false){
                    return (new API)
                        ->isError(__('Payment Method Required'))
                        ->build();
                }else{
                    $payment_method = $request->payment_method;
                }
            }
            // check if wallet_used or payment_method_used all not found
            if ($request->wallet_used == false && $request->payment_method_used == false) {
                return (new API)
                    ->isError(__('Payment Method Required'))
                    ->build();
            }
            if ($request->payment_method_used == true && $payment_method == 'CreditCard') {
                if ($used_wallet > 0) {
                    $payment_total += $used_wallet;
                }
                $payment_total = $final_total - $payment_total;
            }
        }
        if ($apply_coupon && $final_total == 0.0 && $use_payment == false) {
            $payment_method = 'Coupon';
        }

        // Saving order
        $order = Order::create([
            'number'                => time(),
            'user_id'               => $user->id,
            'address_id'            => $address->id,
            'coupon_id'             => $coupon_row ? $coupon_row->id : NULL,
            'payment_token'         => $request->payment_token ? $request->payment_token : NULL,
            'payment_method'        => $payment_method,
            'status'                => $payment_method == 'CreditCard' ? Order::STATUS_PAYMENTPENDDING : Order::STATUS_PAID,
            'delivery_charge'       => round($delivery_charge,2),
            'sub_total'             => round($sub_total,2),
            'tax'                   => round($tax_total,2),
            'grand_total'           => round($grand_total,2),
            'discount'              => round($discount,2),
            'payment'               => round($payment_total,2),
            'final_total'           => round($final_total,2),
            'wallet'                => round($used_wallet,2),
            'installation_service'  => $request->installation_service,
        ]);

        $number_of_items = 0;
        if($order){
            // save Customer Promo if found
            if($apply_coupon){
                OrderCoupons::create([
                    'product_discount' => $discount,
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'coupon_id' => $coupon_row->id,
                ]);
                // CustomerPromo::create(['promo_id' => $promo_row->id, 'customer_id' => $customer_id, 'order_id' => $order->id]);
            }
            // Saving order and products details
            foreach ($processed_products as $processed_product) {
                $product = Product::find($processed_product["id"]);
                DB::table('order_products')->insert([
                    'order_id'     => $order->id,
                    'product_id'   => $product->id,
                    'quantity'     => $processed_product["quantity"],
                    'price'        => $processed_product["price"],
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
                // update product quantity
                Product::where("id", $processed_product['id'])->first()->update(["quantity" => $product->quantity - $processed_product["quantity"]]);
                ProductLogs::create([
                    'quantity' => $processed_product["quantity"],
                    'status' => 'OUT',
                    'product_id' => $product->id,
                ]);
                $number_of_items++;
            }
            // save Wallet Log if found
            if ($request->wallet_used == true) {
                $user->update(['wallet' => $my_wallet - $used_wallet]);
                WalletLogs::create([
                    'amount' => $used_wallet,
                    'status' => 'OUT',
                    'user_id' => $user->id,
                ]);
            }
            if ($use_payment == true) {
                // check wallet_used and payment to pay (set_payment_data)
                if ($request->wallet_used == true) {
                    if($final_total > $my_wallet){
                        if($request->payment_method_used == false){
                            return (new API)
                                ->isError(__('Payment Method Required'))
                                ->build();
                        }else {
                            if ($request->payment_method_used == true && $request->payment_method == "CreditCard"){
                                $data_array =  (new Urway)->set_payment_data($order, $user);
                                $call_response = (new Urway)->call_payment($data_array);
                                if(isset($call_response->payid)){
                                    $order->update(['payment_token' => $call_response->payid ?? NULL]);
                                }
                            }
                        }
                    }
                }else{
                    if($request->payment_method_used == false){
                        return (new API)
                            ->isError(__('Payment Method Required'))
                            ->build();
                    }else{
                        if ($request->payment_method_used == true && $request->payment_method == "CreditCard"){
                            $data_array =  (new Urway)->set_payment_data($order, $user);
                            $call_response = (new Urway)->call_payment($data_array);
                            if(isset($call_response->payid)){
                                $order->update(['payment_token' => $call_response->payid ?? NULL]);
                            }
                        }
                    }
                }
            }
            $response = [];
            $response["order_id"] = (int) $order->id;
            $response["number"] = (int) $order->number;
            $response["payment_url"] = (string) (isset($call_response) && isset($call_response->targetUrl) && isset($call_response->payid)) ? $call_response->targetUrl . '?paymentid=' .  $call_response->payid : '';
            return (new API)
                ->isOk(__('Order Paid Successfully'))
                ->setData($response)
                ->build();
        }else{
            return (new API)
                ->isError(__('Order Not Save Error Happen!'))
                ->build();
        }
    }

    public function repayOrder(Request $request, Order $order){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        if($order->status != Order::STATUS_PAYMENTPENDDING){
            return (new API)
                ->isError(__('The order is not pending payment'))
                ->build();
        }
        $data_array =  (new Urway)->set_payment_data($order, $user);
        $call_response = (new Urway)->call_payment($data_array);
        if(isset($call_response->payid)){
            $order->update(['payment_token' => $call_response->payid ?? NULL]);
        }
        $url = (string) (isset($call_response) && isset($call_response->targetUrl) && isset($call_response->payid)) ? $call_response->targetUrl . '?paymentid=' .  $call_response->payid : '';
        return (new API)
            ->isOk(__('Payment Data'))
            ->setData(["payment_url" => $url])
            ->build();
    }

    public function cancel(Request $request, Order $order){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        if(in_array($order->status, [Order::STATUS_ASSIGNED,Order::STATUS_IN_PROCESS,Order::STATUS_DELIVERED])){
            return (new API)
                ->isError(__('It is not possible to cancel now'))
                ->build();
        }
        $order->update([
            'status'        => Order::STATUS_CANCELLED,
            'cancel_reson'  => $request->cancel_reson
        ]);
        return (new API)
            ->isOk(__('Order Cancelled Successfully'))
            ->build();
    }

    public function success_payment(){
        $order = Order::where('number', request('order_number'))->first();
        $order->update(['status' => Order::STATUS_PAID]);
        // $customer = User::find($order->user_id);
        // $system_settings = app_settings();
        // $data = [
        //     'order_number' => $order->number
        // ]
        // try{
        //     Mail::to($customer->email)->send(new \App\Mail\BerryMarket($data));
        // }catch (\Exception $ex) {
        // }
        return (new API)
            ->isOk(__('Data Updated Successfully'))
            ->setData(['order_id' => $order->id])
            ->build();
    }
    public function failed_payment(){
        return (new API)
            ->isError(__('The payment process failed'))
            ->build();
    }

    public function notify_me(Request $request){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        $product = Product::find($request->product);
        if (!$product) {
            return (new API)
                ->isError(__('Product Not Found'))
                ->build();
        }
        if ($product->quantity > $request->quantity) {
            return (new API)
                ->isError(__('The quantity is already available'))
                ->build();
        }
        $product_notification = ProductNotification::where('user_id' , $user->id)->where('product_id' , $product->id)->first();
        if ($product_notification) {
            $product_notification->update(['quantity' => $request->quantity]);
            return (new API)
                ->isOk(__('The order has been sent before and the quantity has been adjusted back to the requested quantity'))
                ->setData(['quantity' => $request->quantity])
                ->build();
        }
        ProductNotification::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);
        return (new API)
            ->isOk(__('The request has been sent to management successfully, and you will be notified as soon as the required quantity is available'))
            ->setData(['quantity' => $request->quantity])
            ->build();
    }
}
