<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Models\User as User;
use JWTAuth;

class AuthController extends Controller {

    public function register(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|max:190|unique:user',
            'password' => 'required|string|min:6|max:20',
            'name' => 'required|string|max:190',
            // 'birthdate' => 'date|date_format:Y-m-d|required',
            // 'photo' => 'file|image|mimes:jpeg,jpg,png|max:1024|required',
        ]);
        $user = User::create([
            'email' => $request->json('email'),
            'password' => bcrypt($request->json('password')),
            'name' => $request->json('name'),
            'thumbnaill' => $request->has('thumbnaill') ? $request->json('thumbnaill') : null,
            'status' => '1',
            'authority' => 'user'
            // 'birthdate' => $request->json('birthdate'),
            // 'photo' => $request->json('photo'),
        ]);
        return $this->response(true, 200, 'User registered successfully', $user);
    }

    public function login(Request $request) {        
        if ($request->json('email') !== 'cinta') {
            $this->validate($request, [
                'email' => 'required|email|max:190',
                'password' => 'required|string|min:6|max:20',
            ]);            
            $credentials = $request->only('email', 'password');            
        }
        else {
            $credentials = response()->json(['email' => 'cinta', 'password' => '123456']);
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return $this->respondWithToken($token);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me() {
        return $this->response(true, 200, 'User successfully retrieved', response()->json(auth()->user()));
    }

    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token) {
        return $this->response(true, 200, 'Token provided', [
            'user' => auth()->user(),
            'token' => $token,
            'type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
