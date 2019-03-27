<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $fillable = [
        'activity_name', 'from_date', 'to_date', 'output_id',
    ];
}
