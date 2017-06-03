<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
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
            $table->string('customer_name', 100);
            $table->string('customer_address', 100);
            $table->string('customer_email_address', 100);
            $table->string('customer_contact_number', 100);
            $table->string('customer_contact_person', 100);
            $table->integer('deleted');
            $table->string('tin', 100);
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
        Schema::dropIfExists('customer');
    }
}
