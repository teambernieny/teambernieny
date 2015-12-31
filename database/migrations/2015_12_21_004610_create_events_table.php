<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('events', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('neighborhood_id')->unsigned();
          $table->foreign('neighborhood_id')->references('id')->on('neighborhoods');
          $table->string('Name');
          $table->date('Date');
          $table->string('Type')->nullable();
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
        Schema::drop('events');
    }
}
