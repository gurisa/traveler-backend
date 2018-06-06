<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction as Transaction;

class TransactionController extends Controller {
    public function all() {
        return Transaction::all()->toJson();
    }
}
