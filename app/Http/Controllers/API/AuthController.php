<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'required|max:255',
        ], [
            'username.required' => 'Username harus diisi!',
            'password.required' => 'Password harus diisi!',
            'username.max' => 'Username maksimal 255 karater!',
            'password.max' => 'Password maksimal 255 karater!',
        ]);

        if ($validator->fails()) {
            return $this->sendJSONError($validator->errors()->first());
        }

        $attempt = Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
            'role' => UserRole::Student,
            'is_active' => true,
        ]);

        if (!$attempt) {
            return $this->sendJSONError('Username dan password tidak valid!');
        }

        $user = Auth::user();
        $token = $user->createToken('app')->plainTextToken;

        return $this->sendJSONSuccess([
            'token' => $token,
        ], 'authenticated successfully');
    }

    function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        $user = auth()->user();
        $user->save();

        return $this->sendJSONSuccess(null, 'logout successfully');
    }
}
