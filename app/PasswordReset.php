<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = [
        'email',
        'token',
    ];
    public $timestamps = false;
    protected $table = 'password_resets';
}
