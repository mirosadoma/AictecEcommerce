<?php

namespace App\Models\PaymentMethodsImages;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodsImage extends Model {

    protected $table = "payment_methods_images";
    protected $guarded = ['id'];

    public function getImagePathAttribute()
    {
        return ($this->image && file_exists(str_replace('/', '\\',public_path($this->image)))) ? url($this->image) : url('assets/logo.png');
    }
}
