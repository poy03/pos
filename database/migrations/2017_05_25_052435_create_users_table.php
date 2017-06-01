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
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 16);
            $table->string('password', 50);
            $table->string('type', 10);
            $table->string('display_name', 100);
            $table->string('themes', 100);
            $table->integer('items_permissions');
            $table->integer('customers_permissions');
            $table->integer('suppliers_permissions');
            $table->integer('users_permissions');
            $table->integer('salesman_permissions');
            $table->integer('sales');
            $table->integer('receiving');
            $table->integer('reports');
            $table->integer('accounts_receivable');
            $table->integer('expenses');
            $table->integer('accounts_payable');
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
        Schema::dropIfExists('tbl_users');
    }
}
