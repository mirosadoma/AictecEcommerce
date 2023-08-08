<?php

namespace App\Models\Coupons;

use Illuminate\Database\Eloquent\Model;

class UsersCoupons extends Model {

    protected $table = "users_coupons";
    protected $guarded = ['id'];
}
