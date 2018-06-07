<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;

class UserController extends Controller {

    public function all() {
        return ($User = User::all()) ? $this->response(true, 200, 'User retrieve successfully', $User) : $this->response(false, 404, 'User not available');
    }

    public function retrieve($User) {
        $User = User::where('id', '=', $User)->orWhere('email', '=', $User)->first();
        return ($User) ? $this->response(true, 200, 'User retrieve successfully', $User) : $this->response(false, 404, 'User not found');
    }

    public function store(Request $request) {
        if ($request->has(['name', 'email', 'password'])) {
            $User = User::create([
                'email' => $request->json('email'),
                'password' => $request->json('password'),
                'name' => $request->json('name'),
                'thumbnaill' => $request->has('thumbnaill') ? $request->json('thumbnaill') : null,
                'status' => 1,
                'authority' => 'user'
            ]);
            return $this->response(true, 200, 'User successfully created', $User);
        }
        return $this->response(false, 404, 'Data not found');
    }

    public function update(Request $request, $User) {
        $User = User::where('id', '=', $User)->orWhere('email', '=', $User)->first();
        if ($User && $request->has(['name'])) {
            $User->update([
                'name' => $request->json('name'),
            ]);
            return $this->retrieve($User->id);
        }
        return $this->response(false, 404, 'User or data not found');
    }

    public function delete($User) {
        $User = User::find($User);
        if ($User) {
            $User->delete();
            return $this->response(true, 200, 'User sucessfully deleted');
        }
        return $this->response(false, 404, 'User not found');
    }
}
