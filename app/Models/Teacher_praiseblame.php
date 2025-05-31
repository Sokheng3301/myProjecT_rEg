<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_praiseblame extends Model
{
    use HasFactory;
    protected $table = 't_praiseblames';
    protected $fillable = [
        'teacher_id',
        'type_praiseblame',
        'provided_by',
        'recieve_date',
    ];
}
