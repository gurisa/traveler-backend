<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportation extends Model {
    protected $table = "transportation";
    protected $primaryKey = "id";
  
    public $incrementing = TRUE;
    public $timestamps = TRUE;
    public $remember = FALSE;
  
    protected $fillable = [];
    protected $hidden = [];
}
