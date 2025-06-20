<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $fillable = [
        'course_code',
        'course_name_kh',
        'course_name_en',
        'course_credit',
        'course_theory',
        'course_execute',
        'course_apply',
        'course_duration',
        'course_type',
        'department_id',
        'course_description',
        'course_purpose',
        'course_outcome',
        'delete_status',
        'deleted_by',
        'deleted_at',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
