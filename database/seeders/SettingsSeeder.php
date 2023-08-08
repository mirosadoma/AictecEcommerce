<?php

namespace Database\Seeders;

use App\Models\Settings\SiteConfig;
use App\Models\Settings\SiteSocial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SiteConfig
        SiteConfig::create([
            'ar'    => [
                'title'             => 'متجر أيك تك',
                'address'           => 'الإدارة الرئيسية المملكة العربية السعودية الرياض - طريق الملك فهد',
                'locale'            => 'ar',
                'site_config_id'    => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'    => [
                'title'             => 'Aictec Ecommerce',
                'address'           => 'Main Administration Kingdom of Saudi Arabia Riyadh - King Fahd Road',
                'locale'            => 'en',
                'site_config_id'    => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'email'                     => "aictec_ecommerce@info.com",
            'phone'                     => +92003299,
            'tax'                       => 15,
            'delivery_charge'           => 120,
            'close'                     => 0,
            'close_msg'                 => '<h1><em><span dir=\"rtl\"><big><strong>قريباً بإذن الله ......</strong></big></span></em></h1>',
            'terms_and_conditions'      => '<h1><em><span dir=\"rtl\"><big><strong>Terms And Conditions</strong></big></span></em></h1>',
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()
        ]);// SiteSocial
        SiteSocial::create([
            'type'                  => 'twitter',
            'value'                 => 'https://www.google.com/',
            'class'                 => 'twitter',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
        // SiteSocial
        SiteSocial::create([
            'type'                  => 'instagram',
            'value'                 => 'https://www.google.com/',
            'class'                 => 'instagram',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
        // SiteSocial
        SiteSocial::create([
            'type'                  => 'linkedin',
            'value'                 => 'https://www.linkedin.com/',
            'class'                 => 'linkedin',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
    }

}
