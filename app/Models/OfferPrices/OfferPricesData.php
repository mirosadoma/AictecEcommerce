<?php

namespace App\Models\OfferPrices;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\Category;
use App\Models\Products\Product;
use App\Models\User;

class OfferPricesData extends Model {

    protected $table = "offer_prices_data";
    protected $guarded = ['id'];

    public function offer_price()
    {
        return $this->belongsTo(OfferPrice::class, 'offer_price_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
