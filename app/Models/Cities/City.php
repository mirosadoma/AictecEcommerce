<?php

namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Districts\District;

class City extends Model {

    use Translatable;
    protected $table = "cities";
    protected $translationForeignKey = "city_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Cities\Translation\City';
    protected $guarded = ['id'];


    public function districts()
    {
        return $this->hasMany(District::class, 'city_id');
    }
}
