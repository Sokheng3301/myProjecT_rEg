<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_studyhistory extends Model
{
    use HasFactory;
    protected $table = 'std_studyhistories';

    protected $fillable = [
        'id_card',
        'class_level',
        'school_name',
        'province',
        'start_year',
        'end_year',
        'certification',
        'rank',
    ];
}
