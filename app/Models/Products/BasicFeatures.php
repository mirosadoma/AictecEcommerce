<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Products\Product;

class BasicFeatures extends Model {

    use Translatable;
    protected $table = "pro_basic_features";
    protected $translationForeignKey = "feature_id";
    public $translatedAttributes = ['title'];
    public $translationModel = 'App\Models\Products\Translation\BasicFeatures';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
