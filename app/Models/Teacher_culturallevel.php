<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_culturallevel extends Model
{
    use HasFactory;
    protected $table = 't_culturallevels';
    protected $fillable = [
        'teacher_id',
        'cultural_level',
        'major_name',
        'recieve_date',
        'country',
    ];
}
