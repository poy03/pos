<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDrDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_dr_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->double('costprice');
            $table->double('price');
            $table->double('total');
            $table->double('total_sales');
            $table->double('total_costprice');
            $table->integer('sales_dr_id');
            $table->integer('item_id');
            $table->integer('user_id');
            $table->integer('customer_id');
            $table->integer('salesman_id');
            $table->integer('date_of_sales');
            $table->integer('datetime_of_sales');
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
        Schema::dropIfExists('sales_dr_detail');
    }
}
