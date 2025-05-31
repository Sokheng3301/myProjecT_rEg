<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_children extends Model
{
    use HasFactory;
    protected $table = 't_childrens';
    protected $fillable = [
        'teacher_id',
        'child_name',
        'gender',
        'birth_date',
        'occupation',
    ];
}
