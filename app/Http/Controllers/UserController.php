<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;

class UserController extends Controller {
   
    public function all() {
        return User::all()->toJson();
    }
}
