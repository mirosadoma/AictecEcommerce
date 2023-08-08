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
use App\Models\Products\ProductLogs;
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
            'weight'                => 2,
            'user_id'               => User::first()->id,
            'category_id'           => Category::first()->id,
            'brand_id'              => Brand::first()->id,
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductLogs::create([
            'quantity' => 30,
            'status' => 'IN',
            'product_id' => 1,
        ]);
        Product::create([
            'ar'                        => [
                'title'             => 'مننتج 2',
                'small_description' => 'وصف صغير للمننتج 2',
                'description'       => 'وصف مننتج وصف مننتج وصف مننتج 2',
                'locale'            => 'ar',
                'product_id'        => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'title'             => 'Product 2',
                'small_description' => 'Product Small Description 2',
                'description'       => 'Product Description Description Description 2',
                'locale'            => 'en',
                'product_id'        => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'model'                 => 'MB20',
            'price'                 => 50.5,
            'old_price'             => 60,
            'quantity'              => 30,
            'weight'                => 2,
            'user_id'               => User::first()->id,
            'category_id'           => Category::first()->id,
            'brand_id'              => Brand::first()->id,
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductLogs::create([
            'quantity' => 30,
            'status' => 'IN',
            'product_id' => 2,
        ]);
        Product::create([
            'ar'                        => [
                'title'             => 'مننتج 3',
                'small_description' => 'وصف صغير للمننتج 3',
                'description'       => 'وصف مننتج وصف مننتج وصف مننتج 3',
                'locale'            => 'ar',
                'product_id'        => 3,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'title'             => 'Product 3',
                'small_description' => 'Product Small Description 3',
                'description'       => 'Product Description Description Description 3',
                'locale'            => 'en',
                'product_id'        => 3,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'model'                 => 'MB20',
            'price'                 => 50.5,
            'old_price'             => 60,
            'quantity'              => 30,
            'weight'                => 2,
            'user_id'               => User::first()->id,
            'category_id'           => Category::first()->id,
            'brand_id'              => Brand::first()->id,
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductLogs::create([
            'quantity' => 30,
            'status' => 'IN',
            'product_id' => 3,
        ]);
        Product::create([
            'ar'                        => [
                'title'             => 'مننتج 4',
                'small_description' => 'وصف صغير للمننتج 4',
                'description'       => 'وصف مننتج وصف مننتج وصف مننتج 4',
                'locale'            => 'ar',
                'product_id'        => 4,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'title'             => 'Product 4',
                'small_description' => 'Product Small Description 4',
                'description'       => 'Product Description Description Description 4',
                'locale'            => 'en',
                'product_id'        => 4,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'model'                 => 'MB20',
            'price'                 => 50.5,
            'old_price'             => 60,
            'quantity'              => 30,
            'weight'                => 2,
            'user_id'               => User::first()->id,
            'category_id'           => Category::first()->id,
            'brand_id'              => Brand::first()->id,
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductLogs::create([
            'quantity' => 30,
            'status' => 'IN',
            'product_id' => 4,
        ]);
        Product::create([
            'ar'                        => [
                'title'             => 'مننتج 5',
                'small_description' => 'وصف صغير للمننتج 5',
                'description'       => 'وصف مننتج وصف مننتج وصف مننتج 5',
                'locale'            => 'ar',
                'product_id'        => 5,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'title'             => 'Product 5',
                'small_description' => 'Product Small Description 5',
                'description'       => 'Product Description Description Description 5',
                'locale'            => 'en',
                'product_id'        => 5,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'model'                 => 'MB20',
            'price'                 => 50.5,
            'old_price'             => 60,
            'quantity'              => 30,
            'weight'                => 2,
            'user_id'               => User::first()->id,
            'category_id'           => Category::first()->id,
            'brand_id'              => Brand::first()->id,
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductLogs::create([
            'quantity' => 30,
            'status' => 'IN',
            'product_id' => 5,
        ]);
        Product::create([
            'ar'                        => [
                'title'             => 'مننتج 6',
                'small_description' => 'وصف صغير للمننتج 6',
                'description'       => 'وصف مننتج وصف مننتج وصف مننتج 6',
                'locale'            => 'ar',
                'product_id'        => 6,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'title'             => 'Product 6',
                'small_description' => 'Product Small Description 6',
                'description'       => 'Product Description Description Description 6',
                'locale'            => 'en',
                'product_id'        => 6,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'model'                 => 'MB20',
            'price'                 => 50.5,
            'old_price'             => 60,
            'quantity'              => 30,
            'weight'                => 2,
            'user_id'               => User::first()->id,
            'category_id'           => Category::first()->id,
            'brand_id'              => Brand::first()->id,
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        ProductLogs::create([
            'quantity' => 30,
            'status' => 'IN',
            'product_id' => 6,
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
