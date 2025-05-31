<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $table = 'operators';
    protected $fillable = [
        'id_card',
        'name',
        'username',
        'email',
        'password',
        'block_status',
        'blocked_date',
        'blocked_by',
    ];

    public function teacher(){
        return $this->hasOne(Teacher::class, 'id_card');
    }
}
