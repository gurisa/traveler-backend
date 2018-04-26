<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route as Route;

class RouteController extends Controller {
    public function all() {
        return Route::all()->toJson();
    }
}
