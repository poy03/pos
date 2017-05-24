<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customer', function (Blueprint $table) {
            $table->increments('customerID');
            $table->string('companyname', 100);
            $table->string('address', 50);
            $table->string('email', 50);
            $table->string('phone', 50);
            $table->string('contactperson', 50);
            $table->integer('deleted');
            $table->string('tin_id', 200);
            $table->double('credit_limit');
            $table->integer('term');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_customer');
    }
}
