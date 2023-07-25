<?php

namespace App\Models\Categories\Translation;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories_translations";
    protected $fillable = ['name'];
    protected $guarded = ['category_id'];
    public $timestamps = false;
}
