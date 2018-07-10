<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportation as Transportation;

class TransportationController extends Controller {

    public function all() {
        return ($data = Transportation::all()) ? $this->response(true, 200, 'Transportation retrieve successfully', $data) : $this->response(false, 404, 'Transportation not available');
    }

    public function retrieve($data) {
        $data = Transportation::where('id', '=', $data)->first();
        return ($data) ? $this->response(true, 200, 'Transportation retrieve successfully', $data) : $this->response(false, 404, 'Transportation not found');
    }

    public function store(Request $request) {
        if ($request->has(['name', 'type', 'capacity'])) {
            $this->validate($request, [
                'name' => 'required|string|max:190',
                'type' => 'required|string|max:190',
                'capacity' => 'required|integer|max:190',
            ]);
            $data = Transportation::create([
                'name' => $request->json('name'),
                'type' => $request->json('type'),
                'capacity' => $request->json('capacity'),
            ]);
            return $this->response(true, 200, 'Transportation successfully created', $data);
        }
        return $this->response(false, 404, 'Data not found');
    }

    public function update(Request $request, $data) {
        $data = Transportation::where('id', '=', $data)->first();
        if ($data && $request->has(['name', 'type', 'capacity'])) {
            $this->validate($request, [
                'name' => 'required|string|max:190',
                'type' => 'required|string|max:190',
                'capacity' => 'required|integer',
            ]);
            $data->update([
                'name' => $request->json('name'),
                'type' => $request->json('type'),
                'capacity' => $request->json('capacity'),
            ]);
            return $this->retrieve($data->id);
        }
        return $this->response(false, 404, 'Transportation or data not found');
    }

    public function delete($data) {
        $data = Transportation::find($data);
        if ($data) {
            $data->delete();
            return $this->response(true, 200, 'Transportation sucessfully deleted');
        }
        return $this->response(false, 404, 'Transportation not found');
    }

    public function status(Request $request, $data) {
        $data = Transportation::where('id', '=', $data)->first();
        if ($data) {
            $data->update([
                'status' => !$data->status,
            ]);
            return $this->retrieve($data->id);
        }
        return $this->response(false, 404, 'Transportation or data not found');
    }

}
