<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seedings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_Id');       
            $table->string('team#1');
            $table->string('team#2');
            $table->string('team#3');
            $table->string('team#4');
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
        Schema::dropIfExists('seedings');
    }
}
