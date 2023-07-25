<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminsSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\SettingsSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\BrandsSeeder;
use Database\Seeders\BannersSeeder;
use Database\Seeders\ShippingCompaniesSeeder;
use Database\Seeders\CouponsSeeder;
use Database\Seeders\ProductsSeeder;
use Database\Seeders\BanksSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminsSeeder::class,
            UsersSeeder::class,
            SettingsSeeder::class,
            RolesSeeder::class,
            CategoriesSeeder::class,
            BrandsSeeder::class,
            BannersSeeder::class,
            ShippingCompaniesSeeder::class,
            CouponsSeeder::class,
            ProductsSeeder::class,
            BanksSeeder::class,
        ]);
    }
}
