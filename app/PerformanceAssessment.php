<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceAssessment extends Model
{
    //
    protected $fillable = [
        'assessment_date', 'observation', 'response', 'observer_id', 'responder_id', 'output_id',
    ];
}
