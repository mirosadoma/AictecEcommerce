<?php

namespace App\Models\Districts\Translation;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "districts_translations";
    protected $fillable = ['name'];
    protected $guarded = ['district_id'];
    public $timestamps = false;
}
