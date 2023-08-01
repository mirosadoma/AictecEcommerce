<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_config', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('tax')->nullable();
            $table->string('delivery_charge')->nullable();
            $table->string('logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('icon')->nullable();
            $table->tinyInteger('close')->default(0);
            $table->text('close_msg')->nullable();
            $table->timestamps();
        });
        Schema::create('site_config_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('address')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('site_config_id')->nullable();
            $table->foreign('site_config_id')->references('id')->on('site_config')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['site_config_id', 'locale']);
            $table->timestamps();
        });
        Schema::create('site_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('value')->nullable();
            $table->string('class')->nullable();
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
        Schema::dropIfExists('site_config');
        Schema::dropIfExists('site_config_translations');
        Schema::dropIfExists('site_contacts');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
