<?php

namespace App\Models\Claims\Translation;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $table = "reasons_translations";
    protected $fillable = ['title'];
    protected $guarded = ['reason_id'];
    public $timestamps = false;
}
