<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class participant extends Model
{
    protected $fillable=[
        'first_name','last_name','tournament_Id','team_Id', 'photo', 'signature','contact'
    ];
}
