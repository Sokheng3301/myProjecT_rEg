<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semesters';
    protected $fillable = [
        'semester',
        'academy_year',
        'start_date',
        'finish_date',
        'finish_status',
        'delete_status',
        'deleted_by',
        'deleted_date',
    ];
}
