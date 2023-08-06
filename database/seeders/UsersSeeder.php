<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Client
        User::create([
            'name'                  => 'عمرو محمد',
            'email'                 => 'amr@amr.com',
            'phone'                 => '512345677',
            'password'              => \Hash::make('123456'),
            'is_active'             => 1,
            'type'                  => 'client',
            'wallet'                => 0,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);

        // Company
        User::create([
            'name'                  => 'مصطفى',
            'email'                 => 'mostafa@mostafa.com',
            'phone'                 => '512345676',
            'password'              => \Hash::make('123456'),
            'company_name'          => 'AICTEC',
            'is_active'             => 1,
            'type'                  => 'company',
            'wallet'                => 0,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
