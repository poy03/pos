<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_dr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('date_of_sales');
            $table->integer('datetime_of_sales');
            $table->integer('terms');
            $table->integer('user_id');
            $table->double('total_cost');
            $table->double('total_sales');
            $table->text('comments');
            $table->integer('date_due');
            $table->integer('overdue_date_1');
            $table->integer('overdue_date_2');
            $table->integer('overdue_date_3');
            $table->integer('customer_id');
            $table->string('customer_name', 100);
            $table->integer('remarks');
            $table->integer('ts_id');
            $table->integer('salesman_id');
            $table->integer('deleted');
            $table->integer('deleted_date');
            $table->integer('deleted_by');
            $table->text('deleted_comment');
            $table->integer('date_delivered');
            $table->text('prepared_by');
            $table->text('released_by');
            $table->text('approved_by');
            $table->text('received_by');
            $table->text('delivered_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_dr');
    }
}
