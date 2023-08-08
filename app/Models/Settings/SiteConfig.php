<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Str;

class SiteConfig extends Model {

    use Translatable;
    protected $table = "site_config";
    protected $translationForeignKey = "site_config_id";
    public $translatedAttributes = [
        'title','description','keywords','address','seo_keywords','seo_description'
    ];
    public $translationModel = 'App\Models\Settings\Translation\SiteConfig';
    protected $guarded = ['id'];

    public function getLogoPathAttribute()
    {
        return ($this->logo && file_exists(str_replace('/', '\\',public_path($this->logo)))) ? url($this->logo) : url('assets/aictec-shop-logo-01.svg');
    }

    public function getFooterLogoPathAttribute()
    {
        return ($this->footer_logo && file_exists(str_replace('/', '\\',public_path($this->footer_logo)))) ? url($this->footer_logo) : url('assets/aictec-shop-logo-02.svg');
    }

    public function getIconPathAttribute()
    {
        return ($this->icon && file_exists(str_replace('/', '\\',public_path($this->icon)))) ? url($this->icon) : url('assets/aictec-shop-logo-01.svg');
    }


    public function getFullPhoneAttribute()
    {
        $full_phone = $this->phone;
        if (Str::length($this->phone) == 9) {
            $full_phone = '+966'.$this->phone;
        }elseif (Str::length($this->phone) == 10) {
            $full_phone = '+966'.substr($this->phone, 1);
        }elseif (Str::length($this->phone) == 12) {
            $full_phone = $this->phone;
        }else{
            $full_phone = '+966'.$this->phone;
        }
        return $full_phone;
    }
}
