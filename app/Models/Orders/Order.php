<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShippingCompanies\ShippingCompany;
use App\Models\Addressess\Address;
use App\Models\Coupons\Coupon;
use App\Models\Orders\OrderProducts;
use App\Models\User;

class Order extends Model {

    protected $table = "orders";
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shipping_company()
    {
        return $this->belongsTo(ShippingCompany::class, 'shipping_company_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function order_products()
    {
        return $this->hasMany(OrderProducts::class, 'order_id');
    }
}
