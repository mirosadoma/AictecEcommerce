<?php

namespace App\Models\Banks\Translation;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = "banks_translations";
    protected $fillable = ['name'];
    protected $guarded = ['bank_id'];
    public $timestamps = false;
}
