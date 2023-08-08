<?php

namespace App\Models\Categories;

use App\Models\OfferPrices\OfferPricesData;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Products\Product;

class Category extends Model {

    use Translatable;
    protected $table = "categories";
    protected $translationForeignKey = "category_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Categories\Translation\Category';
    protected $guarded = ['id'];

    public function getImagePathAttribute()
    {
        return ($this->image && file_exists(str_replace('/', '\\',public_path($this->image)))) ? url($this->image) : url('assets/logo.png');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function offer_prices_data()
    {
        return $this->hasMany(OfferPricesData::class, 'category_id');
    }
}
