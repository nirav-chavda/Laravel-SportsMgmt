<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_Id');
            $table->tinyInteger('round_Id');
            $table->date('f_date')->nullable();
            $table->time('f_time')->nullable();
            $table->smallInteger('team#1_id');
            $table->smallInteger('team#2_id');
            $table->tinyInteger('team#1_goals');
            $table->tinyInteger('team#2_goals');
            $table->smallInteger('winner_id');
            $table->smallInteger('loser_id');
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
        Schema::dropIfExists('fixtures');
    }
}
