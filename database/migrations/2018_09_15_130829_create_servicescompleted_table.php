<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicescompletedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicescompleted', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employeeid');
            $table->integer('serviceid');
            $table->integer('horsename');
            $table->integer('requestdate');
            $table->integer('completiondate');
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
        Schema::dropIfExists('servicescompleted');
    }
}
