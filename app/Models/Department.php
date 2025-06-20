<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';

    protected $fillable = [
        'dep_code',
        'dep_name_kh',
        'dep_name_en',
        'dep_logo',
        'delete_status',
        'deleted_at',
        'deleted_by',
    ];
    protected $casts = [
        'delete_status' => 'integer',
    ];

    // public function courses()
    // {
    //     return $this->hasMany(Course::class, 'department_id');
    // }

    // public function
}
