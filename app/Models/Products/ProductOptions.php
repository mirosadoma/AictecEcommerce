<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;
use Illuminate\Support\Facades\App;

class ProductOptions extends Model {

    protected $table = "products_options";
    protected $guarded = ['id'];

    public function getNameAttribute()
    {
        return (App::getLocale() == 'ar') ? $this->ar_name : $this->en_name;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
