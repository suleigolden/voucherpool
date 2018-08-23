<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_code', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recipientID')->unsigned();
            $table->string('recipientType',50);
            $table->string('code');
            $table->string('expiration',30);
            $table->string('date_of_usage',30);
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
        Schema::dropIfExists('voucher_code');
    }
}
