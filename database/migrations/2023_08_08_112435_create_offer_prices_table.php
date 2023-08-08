<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_prices', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable(); // generated
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('company_url')->nullable();
            $table->string('commercial_registry_file')->nullable();
            $table->string('type')->nullable(); // file || data
            $table->string('file')->nullable();
            $table->timestamps();
        });
        Schema::create('offer_prices_data', function (Blueprint $table) {
            $table->id();
            $table->string('quantity')->nullable();
            $table->unsignedBigInteger('offer_price_id')->nullable();
            $table->foreign('offer_price_id')->references('id')->on('offer_prices')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('offer_prices');
        Schema::dropIfExists('offer_prices_data');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
