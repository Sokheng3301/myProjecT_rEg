<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Studentclass extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $fillable = [
        'class_code',
        'major_id',
        'level_study',
        'year_level',
        'academy_year',
        'graduate_status',
        'delete_status',
        'deleted_by',
        'deleted_date',
    ];

    public function majors(){
        return $this->BelongsTo(Major::class, 'major_id');
    }
    public function departments(){
        return $this->BelongsTo(Department::class, 'department_id');
    }
}
