<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    //
    protected $fillable = [
        'resource_name', 'unit_of_measure', 'standard_price', 'gl_id',
    ];
}
