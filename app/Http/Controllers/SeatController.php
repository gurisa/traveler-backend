<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat as Seat;

class SeatController extends Controller {
    public function all() {
        return Seat::all()->toJson();
    }
}
