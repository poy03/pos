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
        Schema::create('tbl_items', function (Blueprint $table) {
            $table->increments('itemID');
            $table->string('itemname', 100);
            $table->string('category', 50);
            $table->double('sub_costprice');
            $table->double('srp');
            $table->integer('supplierID');
            $table->float('quantity');
            $table->double('costprice');
            $table->integer('deleted');
            $table->integer('reorder');
            $table->string('item_code', 200);
            $table->double('std_price_to_trade_terms');
            $table->double('std_price_to_trade_cod');
            $table->double('price_to_distributors');
            $table->string('unit_of_measure', 100);
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
        Schema::dropIfExists('tbl_items');
    }
}
