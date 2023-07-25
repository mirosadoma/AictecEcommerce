<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;
use App\Models\Banks\Bank;
use App\Models\Orders\Order;
use App\Models\User;

class BanksRequests extends Model {

    protected $table = "banks_requests";
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getImagePathAttribute()
    {
        return ($this->invoice_image && file_exists(str_replace('/', '\\',public_path($this->invoice_image)))) ? url($this->invoice_image) : url('assets/logo.png');

   }
}
