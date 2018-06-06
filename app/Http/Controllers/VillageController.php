<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village as Village;

class VillageController extends Controller {
    public function all() {
        return Village::all()->toJson();
    }
}
