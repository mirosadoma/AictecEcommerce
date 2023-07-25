<?php

namespace App\Models\Products\Translation;

use Illuminate\Database\Eloquent\Model;

class BasicFeatures extends Model
{
    protected $table = "pro_basic_features_translations";
    protected $fillable = ['title'];
    protected $guarded = ['feature_id'];
    public $timestamps = false;
}
