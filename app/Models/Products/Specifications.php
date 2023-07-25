<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Products\Product;

class Specifications extends Model {

    use Translatable;
    protected $table = "pro_specifications";
    protected $translationForeignKey = "spec_id";
    public $translatedAttributes = ['title'];
    public $translationModel = 'App\Models\Products\Translation\Specifications';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
