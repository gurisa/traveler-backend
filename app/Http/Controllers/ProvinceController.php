<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province as Province;

class ProvinceController extends Controller {
    public function all() {
        return ($data = Province::all()) ? $this->response(true, 200, 'Province retrieve successfully', $data) : $this->response(false, 404, 'Province not available');
    }

    public function retrieve($data) {
        $data = Province::where('id', '=', $data)->first();
        return ($data) ? $this->response(true, 200, 'Province retrieve successfully', $data) : $this->response(false, 404, 'Province not found');
    }
}
