<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\ContactUs\ContactUs;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUs::create([
            'name'                  => 'amr1',
            'email'                 => 'amrmohamed@gmail.com',
            'phone'                 => '01276069689',
            'message'               => 'test message 1 test message 1',
            'user_id'               => 2,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ContactUs::create([
            'name'                  => 'amr2',
            'email'                 => 'amr@gmail.com',
            'phone'                 => '01276069688',
            'message'               => 'test message 2 test message 2',
            'user_id'               => NULL,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
