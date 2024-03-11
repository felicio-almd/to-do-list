<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'tb_users';

    protected $fillable = [
        'username',
        'name',
        'password',
    ];

    // Desabilita os timestamps padrão do Eloquent
    public $timestamps = false;
}
