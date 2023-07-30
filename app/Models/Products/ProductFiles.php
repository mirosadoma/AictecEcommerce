<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;

class ProductFiles extends Model {

    protected $table = "products_files";
    protected $guarded = ['id'];

    public function getFilePathAttribute()
    {
        return ($this->file && file_exists(str_replace('/', '\\',public_path($this->file)))) ? url($this->file) : " ";
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
