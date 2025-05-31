<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'class_rooms';
    protected $fillable = [
        'class_room',
        'classroom_en',
        'delete_status',
        'deleted_by',
        'deleted_date',
    ];

    // public function classrooms(){
    //     return $this->belongsTo();
    // }
}
