<?php

namespace App\Models\ShippingCompanies;

use Illuminate\Database\Eloquent\Model;
use App\Models\Orders\Order;

class ShippingCompany extends Model {

    protected $table = "shipping_companies";
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'shipping_company_id');
    }
}
