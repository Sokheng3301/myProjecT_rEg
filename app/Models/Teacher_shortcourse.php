<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_shortcourse extends Model
{
    use HasFactory;
    protected $table = 't_shortcourses';
    protected $fillable = [
        'teacher_id',
        'section',
        'major_name',
        'start_date',
        'finish_date',
        'duration',
        'prepare_by',
        'support_by',
    ];
}
