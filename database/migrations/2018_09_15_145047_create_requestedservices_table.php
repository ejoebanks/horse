<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestedservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestedservices', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('employeeid');
          $table->integer('clientid');
          $table->integer('horsename');
          $table->integer('serviceid');
          $table->integer('requestdate');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requestedservices');
    }
}
