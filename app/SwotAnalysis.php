<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwotAnalysis extends Model
{
    //
    protected $fillable = [
        'swot_input', 'swot_quadrant', 'output_id',
    ];
}
