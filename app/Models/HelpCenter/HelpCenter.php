<?php

namespace App\Models\HelpCenter;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class HelpCenter extends Model {

    use Translatable;
    protected $table = "help_center";
    protected $translationForeignKey = "help_center_id";
    public $translatedAttributes = ['title','content'];
    public $translationModel = 'App\Models\HelpCenter\Translation\HelpCenter';
    protected $guarded = ['id'];
}
