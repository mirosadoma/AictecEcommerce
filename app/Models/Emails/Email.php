<?php

namespace App\Models\Emails;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Email extends Model {

    protected $table = "emails";
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
