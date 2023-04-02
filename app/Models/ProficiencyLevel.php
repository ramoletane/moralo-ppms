<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProficiencyLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_name',
        'level_description',
    ];

}
