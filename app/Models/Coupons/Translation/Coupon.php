<?php

namespace App\Models\Coupons\Translation;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupons_translations";
    protected $fillable = ['name'];
    protected $guarded = ['coupon_id'];
    public $timestamps = false;
}
