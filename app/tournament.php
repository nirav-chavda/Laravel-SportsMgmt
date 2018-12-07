<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tournament extends Model
{
    protected $fillable=[
        'Name','sport_id','host_id','gtype_id','category_id','pool_size','half_time','break_time','seeding_id','duration',
        'reg_fees','new_old','total_teams','venue','start_date'
    ];
}
