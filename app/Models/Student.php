<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'list_status',
        'profile',
        'id_card',
        'fullname_kh',
        'fullname_en',
        'generation',
        'class_id',
        'dropout_status',
        'grauduate_staus',
        'gender',
        'birth_date',
        'hint_password',
        'national',
        'nationality',
        'phone',
        'email',
        'place_of_birth',
        'current_add',

        'father_name',
        'father_age',
        'father_occupation',
        'father_phone',
        'father_add',

        'mother_name',
        'mother_age',
        'mother_occupation',
        'mother_phone',
        'mother_add',

        'sibling',
        'female_sibling',
        'note',
        'block_status',
        'blocked_date',
        'delete_status',
        'deleted_date',
    ];

    public function class(){
        return $this->BelongsTo(Studentclass::class, 'class_id');
    }
}
