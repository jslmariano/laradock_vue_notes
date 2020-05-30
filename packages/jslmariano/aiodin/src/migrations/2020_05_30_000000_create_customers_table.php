<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_CUSTOMERS', function (Blueprint $table) {
            $table->bigIncrements('USERID');
            $table->string('NAME')->default('');
            $table->string('ADDRESS')->default('');
            $table->integer('AGE')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TBL_CUSTOMERS');
    }
}
