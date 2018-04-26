<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model {
    protected $table = "seat";
    protected $primaryKey = "id";
  
    public $incrementing = TRUE;
    public $timestamps = TRUE;
    public $remember = FALSE;
  
    protected $fillable = [];
    protected $hidden = [];
}
