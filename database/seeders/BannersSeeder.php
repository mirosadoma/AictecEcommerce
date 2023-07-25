<?php

namespace Database\Seeders;

use App\Models\Banners\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::create([
            'link'                  => 'google.com',
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        Banner::create([
            'link'                  => 'google.com',
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
