<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model {
    protected $table = "route";
    protected $primaryKey = "id";
  
    public $incrementing = TRUE;
    public $timestamps = TRUE;
    public $remember = FALSE;
  
    protected $fillable = [
        'name', 'origin_id', 'destination_id', 'departure_at', 'return_at', 'transportation_id', 'driver_id'
    ];
    protected $hidden = [];
}
