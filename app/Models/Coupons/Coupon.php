<?php

namespace App\Models\Coupons;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Orders\Order;

class Coupon extends Model {

    use Translatable;
    protected $table = "coupons";
    protected $translationForeignKey = "coupon_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Coupons\Translation\Coupon';
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'shipping_company_id');
    }
}
