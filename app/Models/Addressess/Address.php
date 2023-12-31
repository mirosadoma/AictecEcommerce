<?php

namespace App\Models\Addressess;

use App\Models\Cities\City;
use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Address extends Model {

    protected $table = "addressess";
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'address_id');
    }
}
