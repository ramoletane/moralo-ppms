<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillDevelopmentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_id',
        'development_method_id',
    ];

}
