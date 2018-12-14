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
            $table->integer('tournament_id')->nullable();
            $table->tinyInteger('match_id')->nullable();
            $table->smallInteger('team#1_id')->nullable();
            $table->smallInteger('team#2_id')->nullable();
            $table->tinyInteger('team#1_goals')->nullable();
            $table->tinyInteger('team#2_goals')->nullable();
            $table->smallInteger('winner_id')->nullable();
            $table->smallInteger('loser_id')->nullable();
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
