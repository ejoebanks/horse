<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
          $table->increments('id');
          $table->text('firstname')->default(null);
          $table->text('lastname')->default(null);
          $table->text('address')->default(null);
          $table->text('city')->default(null);
          $table->text('state')->default(null);
          $table->string('email')->default(null);
          $table->string('phonenumber')->default(null);
          $table->string('password')->default(null);
          $table->string('remember_token')->default('0');
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
        Schema::dropIfExists('clients');
    }
}
