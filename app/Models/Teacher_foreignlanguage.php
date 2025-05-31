<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_foreignlanguage extends Model
{
    use HasFactory;
    protected $table = 't_foreignlanguages';
    protected $fillable = [
        'teacher_id',
        'language',
        'reading',
        'writing',
        'conversation',
    ];
}
