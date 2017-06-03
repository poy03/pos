<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->increments('accountID');
            $table->string('username', 50);
            $table->string('password', 50);
            $table->string('type', 10);
            $table->string('employee_name', 50);
            $table->string('themes', 50);
            $table->integer('deleted');
            $table->integer('items');
            $table->integer('customers');
            $table->integer('sales');
            $table->integer('receiving');
            $table->integer('users');
            $table->integer('reports');
            $table->integer('suppliers');
            $table->integer('credits');
            $table->integer('expenses');
            $table->integer('items_modify');
            $table->integer('customers_modify');
            $table->integer('suppliers_modify');
            $table->integer('users_modify');
            $table->integer('salesman');
            $table->integer('salesman_modify');
            $table->integer('items_add');
            $table->integer('customers_add');
            $table->integer('suppliers_add');
            $table->integer('users_add');
            $table->integer('salesman_add');
            $table->integer('accounts_payable');
            $table->integer('payroll');
            $table->integer('display');
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
        Schema::dropIfExists('tbl_users');
    }
}
