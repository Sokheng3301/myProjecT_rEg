<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuthenticate extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'id_card',
        'username',
        'email',
        'password',
        'block_status',
    ];
}
