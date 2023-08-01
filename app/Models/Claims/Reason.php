<?php

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Claims\Claim;

class Reason extends Model {

    use Translatable;
    protected $table = "reasons";
    protected $translationForeignKey = "reason_id";
    public $translatedAttributes = ['title'];
    public $translationModel = 'App\Models\Claims\Translation\Reason';
    protected $guarded = ['id'];

    public function claims()
    {
        return $this->belongsToMany(Claim::class, 'claims_reasons_povit', 'reason_id', 'claim_id');
    }
}
