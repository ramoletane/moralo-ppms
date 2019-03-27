<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganisationalUnit extends Model
{
    //
    protected $fillable = [
        'unit_name', 'parent_unit_id', 'company_id',
    ];
}
