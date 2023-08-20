<?php

namespace App\Models\Settings;

use App\Models\Cities\City;
use Illuminate\Database\Eloquent\Model;

class DeliveryAdderss extends Model {

    protected $table = "site_config";
    protected $guarded = ['id'];

    public function city()
    {
        return $this->belongsTo(City::class, 'address_city');
    }
}
