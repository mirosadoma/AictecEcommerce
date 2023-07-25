<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Bank extends Model {

    use Translatable;
    protected $table = "banks";
    protected $translationForeignKey = "bank_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Banks\Translation\Bank';
    protected $guarded = ['id'];
}
