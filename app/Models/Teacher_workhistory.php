<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_workhistory extends Model
{
    use HasFactory;
    protected $table = 't_workhistories';

    protected $fillable = [
        'teacher_id',
        'work_continue',
        'current_working',
        'start_date',
        'finish_date',
    ];
}
