<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    //
    protected $fillable = [
        'sector_name', 'industry_id',
    ];
}
