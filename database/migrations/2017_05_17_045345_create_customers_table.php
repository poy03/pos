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
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('email_address', 100);
            $table->string('contact_number', 100);
            $table->string('contact_person', 100);
            $table->integer('deleted');
            $table->string('tin_id', 100);
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
