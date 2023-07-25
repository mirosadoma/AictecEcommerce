<?php

namespace Database\Seeders;

use App\Models\ShippingCompanies\ShippingCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class ShippingCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingCompany::create([
            'name'                  => 'Shipping Company 1',
            'price'                 => 25,
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ShippingCompany::create([
            'name'                  => 'Shipping Company 2',
            'price'                 => 15,
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
