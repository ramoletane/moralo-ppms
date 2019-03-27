<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    //
    protected $fillable = [
        'company_name', 'email_address', 'phone_number',
    ];
}
