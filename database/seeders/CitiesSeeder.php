<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Cities\City;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = json_decode(file_get_contents('https://dev-api.aymakan.com.sa/v2/cities'))->data->cities;
        $n = 1;
        if (count($cities) > 0) {
            foreach ($cities as $value) {
                City::create([
                    'ar'                    => [
                        'name'              => !empty($value->city_ar) ? $value->city_ar : $value->city_en,
                        'locale'            => 'ar',
                        'city_id'           => $n,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now(),
                    ],
                    'en'                    => [
                        'name'              => !empty($value->city_en) ? $value->city_en : $value->city_ar,
                        'locale'            => 'en',
                        'city_id'           => $n,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now(),
                    ],
                    'created_at'            => Carbon::now(),
                    'updated_at'            => Carbon::now(),
                ]);
                $n++;
            }
        }
    }
}
