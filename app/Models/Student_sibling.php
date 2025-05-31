<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_sibling extends Model
{
    use HasFactory;
    protected $table = 'std_siblings';

    protected $fillable = [
        'id_card',
        'name',
        'gender',
        'birth_date',
        'occupation',
        'current_add',
        'phone',
    ];
}
