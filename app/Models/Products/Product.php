<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Categories\Category;
use App\Models\Products\ProductImages;
use App\Models\Brands\Brand;
use App\Models\User;

class Product extends Model {

    use Translatable;
    protected $table = "products";
    protected $translationForeignKey = "product_id";
    public $translatedAttributes = ['title','small_description','description'];
    public $translationModel = 'App\Models\Products\Translation\Product';
    protected $guarded = ['id'];

    public function getMainImagePathAttribute()
    {
        return ($this->main_image && file_exists(str_replace('/', '\\',public_path($this->main_image)))) ? url($this->main_image) : url('assets/logo.png');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function product_options()
    {
        return $this->hasMany(ProductOptions::class, 'product_id');
    }

    public function favourates()
    {
        return $this->belongsToMany(User::class, 'favorites', 'product_id', 'user_id');
    }
}
