<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;
use App\Models\Orders\Order;

class OrderProducts extends Model {

    protected $table = "order_products";
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
