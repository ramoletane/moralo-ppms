<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutputPerformanceIndicator extends Model
{
    //
    protected $fillable = [
        'indicator_baseline', 'indicator_target', 'output_id', 'indicator_id',
    ];
}
