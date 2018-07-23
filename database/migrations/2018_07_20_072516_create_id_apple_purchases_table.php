<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdApplePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('id_apple_purchases', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('id_device');

            $table->string('imei');
            $table->string('language');

            $table->integer('apple_id')->unsigned();
            $table->foreign('apple_id')->references('id')->on('apples');

            $table->integer('serial_id')->unsigned();
            $table->foreign('serial_id')->references('id')->on('serials');

            $table->tinyInteger('total_purchase_successful')->nullable();
            $table->tinyInteger('total_puchase_fail')->nullable();
            $table->integer('money_purchased')->nullable();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('id_apple_purchases');
    }
}
