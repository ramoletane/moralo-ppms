<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $fillable = [
        'comment', 'task_id', 'employee_id',
    ];
}
