<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'method_name',
    ];

}
