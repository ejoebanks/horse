<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicespendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicespending', function (Blueprint $table) {
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
        Schema::dropIfExists('servicespending');
    }
}
