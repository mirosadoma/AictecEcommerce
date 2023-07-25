<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number')->nullable();
            $table->float('sub_total')->default(0.0);
            $table->float('tax_total')->default(0.0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('shipping_company_id')->nullable();
            $table->foreign('shipping_company_id')->references('id')->on('shipping_companies')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addressess')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->string('payment_token')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status')->nullable();
            $table->float('final_total')->default(0.0);
            $table->timestamps();
        });
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->float('price')->default(0.0);
            $table->string('quantity')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
