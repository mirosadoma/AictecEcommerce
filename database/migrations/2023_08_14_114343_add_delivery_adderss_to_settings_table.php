<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeliveryAdderssToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_config', function (Blueprint $table) {
            // delivery_adderss
            $table->string('address_title')->nullable();
            $table->string('address_name')->nullable();
            $table->string('address_email')->nullable();
            $table->longText('address_address')->nullable();
            $table->unsignedBigInteger('address_city')->nullable();
            $table->foreign('address_city')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('address_neighbourhood')->nullable();
            $table->string('address_postcode')->nullable();
            $table->string('address_phone')->nullable();
            $table->longText('address_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
