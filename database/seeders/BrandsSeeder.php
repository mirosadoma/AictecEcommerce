<?php

namespace Database\Seeders;

use App\Models\Brands\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name'                  => 'Brand 1',
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        Brand::create([
            'name'                  => 'Brand 2',
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
