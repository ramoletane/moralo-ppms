<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralLedger extends Model
{
    //
    protected $fillable = [
        'gl_code', 'gl_account_name',
    ];
}
