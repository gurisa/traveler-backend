<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country as Country;

class CountryController extends Controller {
    public function all() {
        return Country::all()->toJson();
    }
}
