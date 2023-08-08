<?php

namespace Database\Seeders;

use App\Models\HelpCenter\HelpCenter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class HelpCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HelpCenter::create([
            'ar'                        => [
                'title'             => 'مركز 1',
                'content'           => 'مركز 1',
                'locale'            => 'ar',
                'help_center_id'    => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'title'             => 'HelpCenter 1',
                'content'           => 'HelpCenter 1',
                'locale'            => 'en',
                'help_center_id'    => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        HelpCenter::create([
            'ar'                        => [
                'title'             => 'مركز 2',
                'content'           => 'مركز 2',
                'locale'            => 'ar',
                'help_center_id'    => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'title'             => 'HelpCenter 2',
                'content'           => 'HelpCenter 2',
                'locale'            => 'en',
                'help_center_id'    => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);

    }
}
