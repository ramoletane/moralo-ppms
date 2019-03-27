<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    //
    protected $fillable = [
        'output_name', 'outcome_id', 'sector_id',
    ];
}
