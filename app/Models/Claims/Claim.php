<?php

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Model;
use App\Models\Claims\Reason;
use App\Models\User;

class Claim extends Model {

    protected $table = "claims";
    protected $guarded = ['id'];

    public function claimer()
    {
        return $this->belongsTo(User::class, 'claimer_id');
    }

    public function reply_owner()
    {
        return $this->belongsTo(User::class, 'reply_owner_id');
    }

    public function resons()
    {
        return $this->belongsToMany(Reason::class, 'claims_reasons_povit', 'claim_id', 'reason_id');
    }
}
