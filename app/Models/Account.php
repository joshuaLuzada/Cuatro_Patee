<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'username', 'password', 'role',
    ];

    protected $hidden = [
        'password',
    ];
}