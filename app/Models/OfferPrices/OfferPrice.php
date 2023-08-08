<?php

namespace App\Models\OfferPrices;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\Category;
use App\Models\Products\Product;
use App\Models\User;

class OfferPrice extends Model {

    protected $table = "offer_prices";
    protected $guarded = ['id'];

    public function getFilePathAttribute()
    {
        return ($this->file && file_exists(str_replace('/', '\\',public_path($this->file)))) ? url($this->file) : url('assets/logo.png');
    }
    public function getCommercialRegistryFilePathAttribute()
    {
        return ($this->commercial_registry_file && file_exists(str_replace('/', '\\',public_path($this->commercial_registry_file)))) ? url($this->commercial_registry_file) : url('assets/logo.png');
    }

    public function offer_prices_data()
    {
        return $this->hasMany(OfferPricesData::class, 'offer_price_id');
    }
}
