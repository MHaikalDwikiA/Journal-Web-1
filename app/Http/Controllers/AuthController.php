<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use App\Models\User;

class AuthController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|max:255',
        ], [
            'username.required' => 'Username harus diisi!',
            'username.max' => 'Username hanya boleh diisi maksimal 255 karakter!',
            'password.required' => 'Password harus diisi!',
            'password.max' => 'Password hanya boleh diisi maksimal 255 karakter',
        ]);

        $user = User::isActive()
            ->where('username', $request->username)
            ->where('role', '!=', UserRole::Student)
            ->first();

        if (!$user) {
            return redirect('login')->withError('Username dan password tidak sesuai!');
        }

        if (Hash::check($request->password, $user->password)) {
            Auth::loginUsingId($user->id);

            return redirect()->intended('dashboard')->withSuccess("Selamat Datang {$user->name}");
        }

        return redirect('login')->with('error', 'Username dan password tidak sesuai!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
