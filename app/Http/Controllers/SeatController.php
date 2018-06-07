<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat as Seat;

class SeatController extends Controller {
    public function all() {
        return ($data = Seat::all()) ? $this->response(true, 200, 'Seat retrieve successfully', $data) : $this->response(false, 404, 'Seat not available');
    }

    public function retrieve($data) {
        $data = Seat::where('id', '=', $data)->first();
        return ($data) ? $this->response(true, 200, 'Seat retrieve successfully', $data) : $this->response(false, 404, 'Seat not found');
    }
}
