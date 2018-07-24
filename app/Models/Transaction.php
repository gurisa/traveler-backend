<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    protected $table = "transaction";
    protected $primaryKey = "id";
  
    public $incrementing = TRUE;
    public $timestamps = TRUE;
    public $remember = FALSE;
  
    protected $fillable = [
        'total', 'user_id', 'employee_id', 'status', 'secret'
    ];
    protected $hidden = [];
}
