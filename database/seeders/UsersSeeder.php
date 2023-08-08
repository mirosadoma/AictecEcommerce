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
            'email'                 => 'amrmohamed171996@gmail.com',
            'phone'                 => '512345677',
            'password'              => \Hash::make('123456'),
            'is_active'             => 1,
            'type'                  => 'client',
            'wallet'                => 0,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
