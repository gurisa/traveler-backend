<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee as Employee;

class EmployeeController extends Controller {
    public function all() {
        return Employee::all()->toJson();
    }
}
