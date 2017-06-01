<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('itemname', 100);
            $table->string('category', 100);
            $table->string('item_code', 100);
            $table->string('unit_of_measure', 100);
            $table->double('costprice');
            $table->double('srp');
            $table->double('dealers');
            $table->float('quantity');
            $table->integer('reorder_level');
            $table->integer('supplier_id');
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
        Schema::dropIfExists('tbl_items');
    }
}
