<?php

namespace App\Models\Addressess;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Address extends Model {

    protected $table = "addressess";
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user__id');
    }
}
