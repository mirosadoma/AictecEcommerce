<?php

namespace App\Models\Products\Translation;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products_translations";
    protected $fillable = ['title','small_description','description'];
    protected $guarded = ['product_id'];
    public $timestamps = false;
}
