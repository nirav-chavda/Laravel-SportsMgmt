<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name');
            $table->smallInteger('host_id');
            $table->tinyInteger('sport_id');
            $table->tinyInteger('gtype_id');
            $table->tinyInteger('category_id');
            $table->tinyInteger('pool_size');
            $table->boolean('new_old')->default('1');
            $table->integer('half_time');
            $table->integer('break_time');
            $table->integer('reg_fees');
            $table->tinyInteger('duration');
            $table->tinyInteger('seeding_id')->nullable();
            $table->integer('total_teams');
            $table->boolean('equipments')->default('1');
            $table->string('venue')->nullable();
            $table->date('start_date')->nullable();
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
        Schema::dropIfExists('tournaments');
    }
}
