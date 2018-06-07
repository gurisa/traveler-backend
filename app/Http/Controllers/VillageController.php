<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village as Village;

class VillageController extends Controller {

    public function all() {
        return ($Village = Village::all()) ? $this->response(true, 200, 'Village retrieve successfully', $Village) : $this->response(false, 404, 'Village not available');
    }

    public function retrieve($Village) {
        $Village = Village::where('id', '=', $Village)->first();
        return ($Village) ? $this->response(true, 200, 'Village retrieve successfully', $Village) : $this->response(false, 404, 'Village not found');
    }

    // public function store(Request $request) {
    //     if ($request->has(['name', 'email', 'password'])) {
    //         $Village = Village::create([
    //             'email' => $request->json('email'),
    //             'password' => $request->json('password'),
    //             'name' => $request->json('name'),
    //             'thumbnaill' => $request->has('thumbnaill') ? $request->json('thumbnaill') : null,
    //             'status' => 1,
    //             'authority' => 'Village'
    //         ]);
    //         return $this->response(true, 200, 'Village successfully created', $Village);
    //     }
    //     return $this->response(false, 404, 'Data not found');
    // }

    // public function update(Request $request, $Village) {
    //     $Village = Village::where('id', '=', $Village)->first();
    //     if ($Village && $request->has(['name'])) {
    //         $Village->update([
    //             'name' => $request->json('name'),
    //         ]);
    //         return $this->retrieve($Village->id);
    //     }
    //     return $this->response(false, 404, 'Village or data not found');
    // }

    // public function delete($Village) {
    //     $Village = Village::find($Village);
    //     if ($Village) {
    //         $Village->delete();
    //         return $this->response(true, 200, 'Village sucessfully deleted');
    //     }
    //     return $this->response(false, 404, 'Village not found');
    // }
}
