<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesmanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('salesman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('salesman_name', 150);
            $table->string('salesman_address', 150);
            $table->string('salesman_contact_number', 150);
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
        Schema::dropIfExists('tbl_salesman');
    }
}
