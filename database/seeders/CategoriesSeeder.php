<?php

namespace Database\Seeders;

use App\Models\Categories\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'ar'                        => [
                'name'              => 'قسم 1',
                'locale'            => 'ar',
                'category_id'       => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'name'              => 'Category 1',
                'locale'            => 'en',
                'category_id'       => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'in_site'               => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        Category::create([
            'ar'                        => [
                'name'              => 'قسم 2',
                'locale'            => 'ar',
                'category_id'       => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'name'              => 'Category 2',
                'locale'            => 'en',
                'category_id'       => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'in_site'               => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);

    }
}
