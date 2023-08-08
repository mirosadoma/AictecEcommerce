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
use Database\Seeders\CouponsSeeder;
use Database\Seeders\ProductsSeeder;
use Database\Seeders\ContactUsSeeder;
use Database\Seeders\ClaimsSeeder;
use Database\Seeders\CitiesSeeder;
use Database\Seeders\DistrictsSeeder;
use Database\Seeders\NewslettersSeeder;
use Database\Seeders\PaymentMethodsImagesSeeder;
use Database\Seeders\CommonQuestionsSeeder;
use Database\Seeders\HelpCenterSeeder;

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
            CouponsSeeder::class,
            ProductsSeeder::class,
            ContactUsSeeder::class,
            ClaimsSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            NewslettersSeeder::class,
            PaymentMethodsImagesSeeder::class,
            CommonQuestionsSeeder::class,
            HelpCenterSeeder::class,
        ]);
    }
}
