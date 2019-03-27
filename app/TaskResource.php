<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskResource extends Model
{
    //
    protected $fillable = [
        'quantity', 'unit_price', 'task_id', 'resource_id',
    ];
}
