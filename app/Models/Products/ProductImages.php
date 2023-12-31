<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;

class ProductImages extends Model {

    protected $table = "product_images";
    protected $guarded = ['id'];

    public function getImagePathAttribute()
    {
        return ($this->image && file_exists(str_replace('/', '\\',public_path($this->image)))) ? url($this->image) : url('assets/logo.png');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
