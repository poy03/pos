<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesdrDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_purchases', function (Blueprint $table) {
            $table->increments('purchaseID');
            $table->integer('itemID');
            $table->integer('quantity');
            $table->double('price');
            $table->double('subtotal');
            $table->integer('accountID');
            $table->double('profit');
            $table->double('loss');
            $table->integer('orderID');
            $table->integer('state');
            $table->double('costprice');
            $table->integer('customerID');
            $table->integer('date_ordered');
            $table->integer('deleted');
            $table->integer('salesmanID');
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
        Schema::dropIfExists('tbl_purchases');
    }
}
