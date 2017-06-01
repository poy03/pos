<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('orderID');
            $table->integer('date_ordered');
            $table->integer('datetime_ordered');
            $table->integer('user_id');
            $table->double('total_sales');
            $table->string('type_payment', 20);
            $table->string('customer', 100);
            $table->double('payment');
            $table->double('profits');
            $table->double('loss');
            $table->double('balance');
            $table->double('costprice');
            $table->text('comments');
            $table->integer('deleted');
            $table->integer('date_due');
            $table->integer('overdue_date_1');
            $table->integer('overdue_date_2');
            $table->integer('overdue_date_3');
            $table->integer('customerID');
            $table->integer('approved');
            $table->integer('editID');
            $table->integer('remarks');
            $table->integer('terms');
            $table->integer('ts_orderID');
            $table->integer('salesmanID');
            $table->integer('date_deleted');
            $table->integer('received');
            $table->text('delete_comment');
            $table->integer('deleted_by');
            $table->text('delete_comment');
            $table->text('date_delivered');
            $table->text('pdc_bank');
            $table->text('pdc_check_number');
            $table->text('pdc_date');
            $table->text('pdc_amount');
            $table->text('pdc_status');
            $table->text('pdc_returned');
            $table->integer('date_payment');
            $table->double('payment_change');
            $table->integer('fully_paid');
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
        Schema::dropIfExists('tbl_orders');
    }
}
