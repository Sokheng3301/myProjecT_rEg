<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_pedagogycourse extends Model
{
    use HasFactory;
    protected $table = 't_pedagogycourses';
    protected $fillable = [
        'teacher_id',
        'professional_level',
        'specialty_first',
        'specialty_second',
        'training_system',
        'recieve_date',
    ];
}
