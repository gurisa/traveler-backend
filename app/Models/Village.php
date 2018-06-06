<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vilage extends Model {
    protected $table = "village";
    protected $primaryKey = "id";
  
    public $incrementing = TRUE;
    public $timestamps = TRUE;
    public $remember = FALSE;
  
    protected $fillable = [];
    protected $hidden = [];
}
