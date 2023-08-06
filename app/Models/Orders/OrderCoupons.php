<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use App\Models\Coupons\Coupon;
use App\Models\Orders\Order;
use App\Models\User;

class OrderCoupons extends Model {

    protected $table = "orders_coupons";
    protected $guarded = ['id'];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
