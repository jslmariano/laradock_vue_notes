<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_TRANSACTIONS', function (Blueprint $table) {
            $table->bigIncrements('ORDERID');
            $table->string('NAME')->default('');
            $table->string('ITEM')->default('');
            $table->integer('QUANTITY')->default(0);
            $table->float('UNIT_PRICE')->default(0.00);
            $table->datetime('TRANSACTION_DATE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_TRANSACTIONS');
    }
}
