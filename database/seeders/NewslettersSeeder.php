<?php

namespace Database\Seeders;

use App\Models\Newsletters\Newsletter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class NewslettersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Newsletter::create([
            'email'                     => "amrmohamed171996@gmail.com",
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()
        ]);
        Newsletter::create([
            'email'                     => "amr@gmail.com",
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()
        ]);
    }
}
