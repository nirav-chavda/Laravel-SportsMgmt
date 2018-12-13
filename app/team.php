<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    protected $table = 'teams';

    protected $fillable = ['tournament_Id','name'];
}
