<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country as Country;

class CountryController extends Controller {
    public function all() {
        return ($data = Country::all()) ? $this->response(true, 200, 'Country retrieve successfully', $data) : $this->response(false, 404, 'Country not available');
    }

    public function retrieve($data) {
        $data = Country::where('id', '=', $data)->first();
        return ($data) ? $this->response(true, 200, 'Country retrieve successfully', $data) : $this->response(false, 404, 'Country not found');
    }
}
