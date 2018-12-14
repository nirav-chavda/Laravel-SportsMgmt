<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fixture extends Model
{
    protected $fillable=[
        'tournament_id','match_id','team1_id','team2_id','team1_goals','team2_goals','loser_id','winner_id'
    ];
}
