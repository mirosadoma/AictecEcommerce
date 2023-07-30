<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Products\Product;
use App\Models\Products\BasicFeatures;
use App\Models\Products\ProductOptions;
use App\Models\Products\ProductFiles;
use App\Models\Brands\Brand;
use App\Models\Categories\Category;
use App\Models\User;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'ar'                        => [
                'title'             => 'مننتج 1',
                'small_description' => 'وصف صغير للمننتج 1',
                'description'       => 'وصف مننتج وصف مننتج وصف مننتج 1',
                'locale'            => 'ar',
                'product_id'        => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'title'             => 'Product 1',
                'small_description' => 'Product Small Description 1',
                'description'       => 'Product Description Description Description 1',
                'locale'            => 'en',
                'product_id'        => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'model'                 => 'MB20',
            'price'                 => 50.5,
            'old_price'             => 60,
            'quantity'              => 30,
            'user_id'               => User::first()->id,
            'category_id'           => Category::first()->id,
            'brand_id'              => Brand::first()->id,
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        BasicFeatures::create([
            'ar'                        => [
                'title'                 => 'ميزة 1',
                'locale'                => 'ar',
                'feature_id'            => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            'en'                        => [
                'title'                 => 'Feature 1',
                'locale'                => 'en',
                'feature_id'            => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            'product_id'            => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        BasicFeatures::create([
            'ar'                        => [
                'title'                 => 'ميزة 2',
                'locale'                => 'ar',
                'feature_id'            => 2,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            'en'                        => [
                'title'                 => 'Feature 2',
                'locale'                => 'en',
                'feature_id'            => 2,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            'product_id'            => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        BasicFeatures::create([
            'ar'                        => [
                'title'                 => 'ميزة 3',
                'locale'                => 'ar',
                'feature_id'            => 3,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            'en'                        => [
                'title'                 => 'Feature 3',
                'locale'                => 'en',
                'feature_id'            => 3,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            'product_id'            => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductOptions::create([
            'ar_name'               => 'الوزن',
            'en_name'               => 'weaight',
            'value'                 => 'value 1',
            'product_id'            => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductOptions::create([
            'ar_name'               => 'الوزن',
            'en_name'               => 'weaight',
            'value'                 => 'value 1',
            'product_id'            => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductOptions::create([
            'ar_name'               => 'الوزن',
            'en_name'               => 'weaight',
            'value'                 => 'value 1',
            'product_id'            => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductOptions::create([
            'ar_name'               => 'الوزن',
            'en_name'               => 'weaight',
            'value'                 => 'value 1',
            'product_id'            => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductOptions::create([
            'ar_name'               => 'الوزن',
            'en_name'               => 'weaight',
            'value'                 => 'value 1',
            'product_id'            => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
