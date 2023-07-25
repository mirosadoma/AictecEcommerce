<?php

namespace App\Models\Products\Translation;

use Illuminate\Database\Eloquent\Model;

class Specifications extends Model
{
    protected $table = "pro_specifications_translations";
    protected $fillable = ['title'];
    protected $guarded = ['spec_id'];
    public $timestamps = false;
}
