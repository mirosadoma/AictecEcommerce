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
            $table->float('tax')->default(0.0);
            $table->float('grand_total')->default(0.0);
            $table->float('discount')->default(0.0);
            $table->float('payment')->default(0.0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addressess')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->string('payment_token')->nullable();
            $table->enum('payment_method', ['CreditCard', 'CashOnDelivery', 'Wallet','Coupon'])->nullable();
            $table->enum('status', ['payment_pendding', 'paid', 'in_process', 'assigned', 'delivered', 'cancelled'])->nullable();
            $table->string('wallet')->nullable();
            $table->float('delivery_charge')->default(0.0);
            $table->float('final_total')->default(0.0);
            $table->tinyInteger('installation_service')->default(0); // خدمة التركيب
            $table->longText('cancel_reson')->nullable();
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
        Schema::create('orders_coupons', function (Blueprint $table) {
            $table->id();
            $table->float('product_discount')->default(0.0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('users_coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('orders_coupons');
        Schema::dropIfExists('users_coupons');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
