<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->tinyInteger('in_site')->default(0);
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });
        Schema::create('categories_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['category_id', 'locale']);
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('categories_translations');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
