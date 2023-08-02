<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $isInactive = $request->view == 'inactive';

        $activeCount = User::isActive()->count();
        $inactiveCount = User::isInactive()->count();

        $query = User::query();

        if ($isInactive) {
            $query->isInactive();
        } else {
            $query->isActive();
        }

        $users = $query->get();

        $currentId = auth()->id();

        return view(
            'users.index',
            compact(
                'users',
                'activeCount',
                'inactiveCount',
                'currentId'
            )
        );
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|alpha_num:ascii|unique:users,username|min:5|max:255',
            'password' => 'required|confirmed|min:5|max:255',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Nama harus diisi!',
            'username.required' => 'Username harus diisi!',
            'username.alpha_num' => 'Username hanya boleh diisi karakter A-Z a-z 0-9!',
            'password.required' => 'Password harus diisi!',
            'name.max' => 'Maksimal 255 karakter!',
            'username.max' => 'Maksimal 255 karakter!',
            'username.unique' => 'Username telah digunakan oleh akun lain!',
            'password.max' => 'Maksimal 255 karakter!',
            'username.min' => 'Minimal 5 karakter!',
            'password.min' => 'Minimal 5 karakter!',
            'password.confirmed' => 'Password dan Password konfirmasi tidak sama!',
            'is_active.required' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi aktif / tidak aktif!',
        ]);

        User::create([
            'role' => UserRole::Admin,
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('users.index')->withSuccess('Pengguna berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        abort_if(!$user, 400, 'Pengguna tidak ditemukan');

        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        abort_if(!$user, 400, 'Pengguna tidak ditemukan');

        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|alpha_num:ascii|unique:users,username,' . $user->id . '|min:5|max:255',
            'password' => 'nullable|confirmed|min:5|max:255',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Nama harus diisi!',
            'username.required' => 'Username harus diisi!',
            'username.alpha_num' => 'Username hanya boleh diisi karakter A-Z a-z 0-9!',
            'name.max' => 'Maksimal 255 karakter!',
            'username.max' => 'Maksimal 255 karakter!',
            'username.unique' => 'Username telah digunakan oleh akun lain!',
            'password.max' => 'Maksimal 255 karakter!',
            'username.min' => 'Minimal 5 karakter!',
            'password.min' => 'Minimal 5 karakter!',
            'password.confirmed' => 'Password dan Passwork konfirmasi tidak sama!',
            'is_active.request' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi aktif / tidak aktif!',
        ]);

        $user->name = $request->name;
        $user->is_active = $request->is_active;
        $user->username = $request->username;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->withSuccess('Pengguna berhasil diubah!');
    }

    public function remove($id)
    {
        $user = User::find($id);
        abort_if(!$user, 400, 'Pengguna tidak ditemukan');

        $user->delete();

        return redirect()->route('users.index')->withSuccess('Pengguna berhasil dihapus!');
    }

}
