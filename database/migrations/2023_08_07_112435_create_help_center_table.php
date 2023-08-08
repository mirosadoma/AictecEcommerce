<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_center', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });
        Schema::create('help_center_translations', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('help_center_id')->nullable();
            $table->foreign('help_center_id')->references('id')->on('help_center')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['help_center_id', 'locale']);
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
        Schema::dropIfExists('help_center');
        Schema::dropIfExists('help_center_translations');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
