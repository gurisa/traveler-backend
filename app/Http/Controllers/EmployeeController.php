<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee as Employee;

class EmployeeController extends Controller {

    public function all() {
        return ($data = Employee::all()) ? $this->response(true, 200, 'Employee retrieve successfully', $data) : $this->response(false, 404, 'Employee not available');
    }

    public function retrieve($data) {
        $data = Employee::where('id', '=', $data)->first();
        return ($data) ? $this->response(true, 200, 'Employee retrieve successfully', $data) : $this->response(false, 404, 'Employee not found');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:190',
            'status' => 'required|string|max:190',
            'position' => 'required|string|max:190',
        ]);

        $data = Employee::create([
            'name' => $request->json('name'),
            'status' => $request->json('status'),
            'position' => $request->json('position'),
        ]);
        return $this->response(true, 200, 'Employee successfully created', $data);
    }

    public function update(Request $request, $data) {
        $data = Employee::where('id', '=', $data)->first();
        if ($data) {
            $this->validate($request, [
                'name' => 'required|string|max:190',
                'status' => 'required|string|max:190',
                'position' => 'required|string|max:190',
            ]);
            
            $data->update([
                'name' => $request->json('name'),
                'status' => $request->json('status'),
                'position' => $request->json('position'),
            ]);
            return $this->retrieve($data->id);
        }
        return $this->response(false, 404, 'Employee or data not found');
    }

    public function delete($data) {
        $data = Employee::find($data);
        if ($data) {
            $data->delete();
            return $this->response(true, 200, 'Employee sucessfully deleted');
        }
        return $this->response(false, 404, 'Employee not found');
    }
}
