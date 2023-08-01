<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Claims\Claim;
use App\Models\Claims\Reason;

class ClaimsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reason::create([
            'ar'                    => [
                'title'             => 'المنتج',
                'locale'            => 'ar',
                'reason_id'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                    => [
                'title'             => 'Product',
                'locale'            => 'en',
                'reason_id'          => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        Reason::create([
            'ar'                    => [
                'title'             => 'عملية الشحن',
                'locale'            => 'ar',
                'reason_id'          => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                    => [
                'title'             => 'Shipping process',
                'locale'            => 'en',
                'reason_id'          => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        Reason::create([
            'ar'                    => [
                'title'             => 'تجربة الموقع',
                'locale'            => 'ar',
                'reason_id'          => 3,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                    => [
                'title'             => 'Site experience',
                'locale'            => 'en',
                'reason_id'          => 3,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        Reason::create([
            'ar'                    => [
                'title'             => 'أخرى',
                'locale'            => 'ar',
                'reason_id'          => 4,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                    => [
                'title'             => 'Other',
                'locale'            => 'en',
                'reason_id'          => 4,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        Claim::create([
            'name'                  => 'amr1',
            'email'                 => 'amrmohamed@gmail.com',
            'phone'                 => '01276069689',
            'message'               => 'test message 1 test message 1',
            'claimer_id'            => 2,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        \DB::table('claims_reasons_povit')->insert([
            'claim_id' => 1,
            'reason_id' => 1,
        ]);
    }
}
