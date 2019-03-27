<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceIndicator extends Model
{
    //
    protected $fillable = [
        'indicator_name', 'indicator_type', 'unit_of_measure',
    ];
}
