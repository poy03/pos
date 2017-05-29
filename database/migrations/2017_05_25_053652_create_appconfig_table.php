<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppconfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app_name', 100);
            $table->string('type_payment', 100);
            $table->string('address', 100);
            $table->string('contact_number', 100);
            $table->string('app_company_name', 100);
            $table->float('maximum_items_displayed');
            $table->text('logo');
            $table->integer('accounting_period');
            $table->integer('statementID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_config');
    }
}
