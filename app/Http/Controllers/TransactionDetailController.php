<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail as TransactionDetail;

class TransactionDetailController extends Controller {
    public function all() {
        return TransactionDetail::all()->toJson();
    }
}
