<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

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
        return ($this->logo && file_exists(str_replace('/', '\\',public_path($this->logo)))) ? url($this->logo) : url('assets/logo.png');
    }

    public function getFooterLogoPathAttribute()
    {
        return ($this->footer_logo && file_exists(str_replace('/', '\\',public_path($this->footer_logo)))) ? url($this->footer_logo) : url('assets/logo.png');
    }

    public function getIconPathAttribute()
    {
        return ($this->icon && file_exists(str_replace('/', '\\',public_path($this->icon)))) ? url($this->icon) : url('assets/logo.png');
    }

    public function getPhoneNumberAttribute()
    {
        return $this->phone ? "966".$this->phone . "+" : $this->phone;
    }
}
