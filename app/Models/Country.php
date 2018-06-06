<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    protected $table = "country";
    protected $primaryKey = "id";
  
    public $incrementing = TRUE;
    public $timestamps = TRUE;
    public $remember = FALSE;
  
    protected $fillable = [];
    protected $hidden = [];
}
