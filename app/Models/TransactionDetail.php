<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model {
    protected $table = "transaction_detail";
    protected $primaryKey = "id";
  
    public $incrementing = TRUE;
    public $timestamps = TRUE;
    public $remember = FALSE;
  
    protected $fillable = [
        'transaction_id', 'route_id', 'amount', 'price'
    ];
    protected $hidden = [];
}
