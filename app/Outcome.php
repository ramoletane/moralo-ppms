<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    //
    protected $fillable = [
        'outcome_name', 'impact_id', 'company_id',
    ];
}
