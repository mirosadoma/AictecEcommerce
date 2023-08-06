<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('model')->nullable();
            $table->float('price')->default(0.0);
            $table->float('old_price')->default(0.0);
            $table->string('quantity')->nullable();
            $table->string('main_image')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('products_translations', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->longText('small_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['product_id', 'locale']);
            $table->timestamps();
        });
        Schema::create('products_options', function (Blueprint $table) {
            $table->id();
            $table->string('ar_name')->nullable();
            $table->string('en_name')->nullable();
            $table->string('value')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('pro_basic_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('pro_basic_features_translations', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('feature_id')->nullable();
            $table->foreign('feature_id')->references('id')->on('pro_basic_features')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['feature_id', 'locale']);
            $table->timestamps();
        });
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('products_files', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('size')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('product_logs', function (Blueprint $table) {
            $table->id();
            $table->string('quantity')->nullable();
            $table->enum('status', ['IN', 'OUT'])->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('product_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('quantity')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('products_translations');
        Schema::dropIfExists('products_options');
        Schema::dropIfExists('pro_basic_features');
        Schema::dropIfExists('pro_basic_features_translations');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products_files');
        Schema::dropIfExists('product_logs');
        Schema::dropIfExists('product_notifications');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
