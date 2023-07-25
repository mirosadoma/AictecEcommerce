<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('iban')->nullable();
            $table->bigInteger('account_number')->default(0);
            $table->string('account_owner')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });

        Schema::create('banks_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['bank_id', 'locale']);
            $table->timestamps();
        });

        Schema::create('banks_requests', function (Blueprint $table) {
            $table->id();
            $table->string('account_owner')->nullable();
            $table->bigInteger('account_number');
            $table->string('iban')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('total')->default(0);
            $table->string('invoice_image')->nullable();
            $table->tinyInteger('is_accept')->default(0);
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
        Schema::dropIfExists('banks');
        Schema::dropIfExists('banks_translations');
        Schema::dropIfExists('banks_requests');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
