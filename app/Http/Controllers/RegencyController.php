<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regency as Regency;

class RegencyController extends Controller {
    public function all() {
        return ($data = Regency::all()) ? $this->response(true, 200, 'Regency retrieve successfully', $data) : $this->response(false, 404, 'Regency not available');
    }

    public function retrieve($data) {
        $data = Regency::where('id', '=', $data)->first();
        return ($data) ? $this->response(true, 200, 'Regency retrieve successfully', $data) : $this->response(false, 404, 'Regency not found');
    }
}
