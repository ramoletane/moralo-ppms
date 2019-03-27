<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = [
        'staff_number', 'firstname', 'surname', 'job_title', 'email_address', 'phone_number', 'unit_id',
    ];
}
