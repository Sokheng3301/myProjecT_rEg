<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Major extends Model
{
    use HasFactory;
    protected $table = 'majors';
    protected $fillable =[
        'major_code',
        'major_name_kh',
        'major_name_en',
        'department_id',
        'deleted_at',
        'deleted_by',
        'delete_status',
    ];

    public function departments(){
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function classes()
    {
        return $this->hasMany(Studentclass::class, 'major_id');
    }

}
