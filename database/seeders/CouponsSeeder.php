<?php

namespace Database\Seeders;

use App\Models\Coupons\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'ar'                        => [
                'name'              => 'كوبون 1',
                'locale'            => 'ar',
                'coupon_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'name'              => 'Coupon 1',
                'locale'            => 'en',
                'coupon_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'start_date'            => Carbon::today()->format('Y-m-d'),
            'end_date'              => Carbon::today()->addDays(30)->format('Y-m-d'),
            'value'                 => 120,
            'type'                  => 'amount',// amount  -  percentage
            'code'                  => 'EX-123',
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);

    }
}
