<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addressess', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('street_address')->nullable();
            $table->string('building_number')->nullable();
            $table->string('floor_number')->nullable();
            $table->unsignedBigInteger('usrer_id');
            $table->foreign('usrer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('addressess');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
