<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    protected $table = 'user';
    // protected $primaryKey = "id";
  
    public $incrementing = FALSE;
    public $timestamps = TRUE;
    public $remember = TRUE;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
