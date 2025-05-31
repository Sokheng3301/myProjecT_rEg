<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_professional extends Model
{
    use HasFactory;
    protected $table='t_professionals';
    protected $fillable = [
        'teacher_id',
        'type_professional',
        'description',
        'number_anountment',
        'recieve_date',
    ];
}
