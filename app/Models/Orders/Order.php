<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShippingCompanies\ShippingCompany;
use App\Models\Addressess\Address;
use App\Models\Cities\City;
use App\Models\Coupons\Coupon;
use App\Models\Districts\District;
use App\Models\Orders\OrderProducts;
use App\Models\User;

class Order extends Model {

    protected $table = "orders";
    protected $guarded = ['id'];

    const STATUS_PAYMENTPENDDING    = 'payment_pendding';
    const STATUS_PLACED             = 'placed';
    const STATUS_IN_PROCESS         = 'in_process';
    const STATUS_FIFNISHED          = 'finished';
    const STATUS_CANCELED           = 'canceled';

    public static function getOrderStatuses($status = NULL) {
        if ($status == NULL) {
            $status[static::STATUS_PAYMENTPENDDING]         = ucwords(strtolower(str_replace('_',' ',static::STATUS_PAYMENTPENDDING)));
            $status[static::STATUS_PLACED]                  = ucwords(strtolower(str_replace('_',' ',static::STATUS_PLACED)));
            $status[static::STATUS_IN_PROCESS]              = ucwords(strtolower(str_replace('_',' ',static::STATUS_IN_PROCESS)));
            $status[static::STATUS_FIFNISHED]               = ucwords(strtolower(str_replace('_',' ',static::STATUS_FIFNISHED)));
            $status[static::STATUS_CANCELED]                = ucwords(strtolower(str_replace('_',' ',static::STATUS_CANCELED)));
            return $status;
        } else {
           return ucwords(strtolower(str_replace('_',' ',$status)));
        }
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

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
