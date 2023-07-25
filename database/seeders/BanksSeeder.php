<?php

namespace Database\Seeders;

use App\Models\Banks\Bank;
use App\Models\Banks\BanksRequests;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
            'ar'                        => [
                'name'              => 'بنك الراجحى 1',
                'locale'            => 'ar',
                'bank_id'           => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'name'              => 'Bank El-Raghy 1',
                'locale'            => 'en',
                'bank_id'           => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'iban'                  => 'adsd561n651ertdrfyh',
            'account_number'        => '1234567891234567',
            'account_owner'         => 'AMR MOHAMED',
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);

        BanksRequests::create([
            'account_owner'         => 'AMR MOHAMED',
            'account_number'        => '1234567891234566',
            'iban'                  => 'sdfdbs6dhtrfgrsrd',
            'user_id'               => 2,
            'bank_id'               => 1,
            'order_id'              => NULL,
            'is_accept'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);

    }
}
