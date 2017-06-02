<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_suppliers', function (Blueprint $table) {
            $table->increments('supplierID');
            $table->string('supplier_name', 100);
            $table->string('supplier_company', 100);
            $table->string('supplier_number', 100);
            $table->string('supplier_address', 100);
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
        Schema::dropIfExists('tbl_suppliers');
    }
}
