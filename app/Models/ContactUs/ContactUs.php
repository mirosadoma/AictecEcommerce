<?php

namespace App\Models\ContactUs;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ContactUs extends Model {

    protected $table = "contact_us";
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reply_owner()
    {
        return $this->belongsTo(User::class, 'reply_owner_id');
    }
}
