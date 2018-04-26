<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model {
    protected $table = "regency";
    protected $primaryKey = "id";
  
    public $incrementing = TRUE;
    public $timestamps = TRUE;
    public $remember = FALSE;
  
    protected $fillable = [];
    protected $hidden = [];
}
