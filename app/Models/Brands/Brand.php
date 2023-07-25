<?php

namespace App\Models\Brands;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;

class Brand extends Model {

    protected $table = "brands";
    protected $guarded = ['id'];

    public function getImagePathAttribute()
    {
        return ($this->image && file_exists(str_replace('/', '\\',public_path($this->image)))) ? url($this->image) : url('assets/logo.png');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'brand_id');
    }
}
