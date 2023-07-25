<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('code')->nullable();
            $table->string('type')->nullable();// amount  -  percentage
            $table->string('value')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });
        Schema::create('coupons_translations', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['coupon_id', 'locale']);
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
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('coupons_translations');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
