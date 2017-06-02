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
        //
        Schema::create('tbl_items_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itemID');
            $table->float('quantity');
            $table->string('type', 100);
            $table->text('remarks');
            $table->integer('ref_id');
            $table->integer('date_time');
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
        //
        Schema::dropIfExists('tbl_items_history');
    }
}
