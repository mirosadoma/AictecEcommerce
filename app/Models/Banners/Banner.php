<?php

namespace App\Models\Banners;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    protected $table = "banners";
    protected $guarded = ['id'];

    public function getImagePathAttribute()
    {
        return ($this->image && file_exists(str_replace('/', '\\',public_path($this->image)))) ? url($this->image) : url('assets/logo.png');
    }
}
