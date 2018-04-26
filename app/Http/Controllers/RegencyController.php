<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regency as Regency;

class RegencyController extends Controller {
    public function all() {
        return Regency::all()->toJson();
    }
}
