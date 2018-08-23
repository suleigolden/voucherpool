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
            $table->string('recipientType',10);
            $table->string('code');
            $table->date('expiration');
            $table->date('date_of_usage');
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
