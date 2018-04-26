<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportation as Transportation;

class TransportationController extends Controller {
    public function all() {
        return Transportation::all()->toJson();
    }
}
