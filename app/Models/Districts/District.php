<?php

namespace App\Models\Districts;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Cities\City;

class District extends Model {

    use Translatable;
    protected $table = "districts";
    protected $translationForeignKey = "district_id";
    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Districts\Translation\District';
    protected $guarded = ['id'];


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
