<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $fillable = [
        'id_card',
        'profile',
        'fullname_kh',
        'fullname_en',
        'department_id',
        'leave_status',
        'leave_description',
        'leave_date',
        'leave_by',
        'gender',
        'birth_date',
        'nationality',
        'disability',
        'officer_id',
        'id_number',
        'place_of_birth',
        'payroll_acc',
        'memeber_bcc',
        'employment_date',
        'soup_date',
        'working_unit',
        'working_unit_add',
        'office',
        'position',
        'anountment',
        'rank',
        'refer',
        'numbering',
        'last_interest_date',
        'dated',
        'teach_in_year',
        'english_teach',
        'three_level_combine',
        'technic_team_leader',
        'help_teach',
        'two_class',
        'class_charge',
        'cross_school',
        'overtime',
        'coupling_class',
        'two_lang',
        'work_status',
        'family_status',
        'must_be',
        'occupation',
        'name_confederate',
        'confederation',
        'birth_date_spouse',
        'wife_salary',
        'phone_number',
        'email_add',
        'current_add',
        'delete_status',
        'deleted_date',
        'deleted_by',
        'block_status',
    ];
    public function operator(){
        return $this->belongsTo(Operator::class, 'id_card');
    }
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }



}
