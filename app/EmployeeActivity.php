<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeActivity extends Model
{
    //
    protected $fillable = [
        'assignment_date', 'employee_id', 'activity_id',
    ];
}
