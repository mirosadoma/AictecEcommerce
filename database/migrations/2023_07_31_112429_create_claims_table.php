<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });
        Schema::create('reasons_translations', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('reason_id')->nullable();
            $table->foreign('reason_id')->references('id')->on('reasons')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['reason_id', 'locale']);
            $table->timestamps();
        });
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claimer_id')->nullable();
            $table->foreign('claimer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('message')->nullable();
            $table->unsignedBigInteger('reply_owner_id')->nullable();
            $table->foreign('reply_owner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->text('reply')->nullable();
            $table->timestamp('reply_date')->nullable();
            $table->timestamps();
        });
        Schema::create('claims_reasons_povit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id')->nullable();
            $table->foreign('claim_id')->references('id')->on('claims')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('reason_id')->nullable();
            $table->foreign('reason_id')->references('id')->on('reasons')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('claims');
        Schema::dropIfExists('reasons');
        Schema::dropIfExists('reasons_translations');
        Schema::dropIfExists('claims_reasons_povit');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
