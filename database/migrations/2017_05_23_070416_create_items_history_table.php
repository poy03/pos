<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->string('type', 100);
            $table->text('remarks');
            $table->string('ref_id',100);
            $table->integer('date_entry');
            $table->integer('datetime_entry');
            $table->integer('accountID');
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
        Schema::dropIfExists('tbl_items_history');
    }
}
