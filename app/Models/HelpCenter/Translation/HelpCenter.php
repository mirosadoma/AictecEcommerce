<?php

namespace App\Models\HelpCenter\Translation;

use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    protected $table = "help_center_translations";
    protected $fillable = ['title','content'];
    protected $guarded = ['help_center_id'];
    public $timestamps = false;
}
