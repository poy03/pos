<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_payments', function (Blueprint $table) {
            $table->increments('paymentID');
            $table->double('balance');
            $table->text('type_payment');
            $table->double('amount');
            $table->double('excess');
            $table->text('pdc_check_number');
            $table->integer('pdc_date');
            $table->text('pdc_bank');
            $table->text('ar_number');
            $table->integer('pdc_returned');
            $table->integer('date_payment');
            $table->integer('orderID');
            $table->text('status');
            $table->integer('not_valid');
            $table->integer('accountID');
            $table->integer('deleted');
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
        Schema::dropIfExists('tbl_payments');
    }
}
