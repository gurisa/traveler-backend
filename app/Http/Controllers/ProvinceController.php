<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province as Province;

class ProvinceController extends Controller {
    public function all() {
        return Province::all()->toJson();
    }
}
