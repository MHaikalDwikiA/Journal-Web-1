<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Storage;
use Validator;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return $this->sendJSONSuccess([
            'name' => $user->name,
            'username' => $user->username,
            'role' => $user->role,
            'photo' => $user->photo ? Storage::url($user->photo) : asset('assets/img/user.png'),
            'is_active' => $user->is_active,
        ], 'successfully load profile');
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:5048',
            'password' => 'nullable|string|min:5|max:255',
            'old_password' => 'required_with:password|string|max:255',
        ], [
            'name.max' => 'Nama maksimal 255 karakter',
            'name.string' => 'Nama harus berformat string',
            'photo.image' => 'Foto harus berupa gambar',
            'photo.max' => 'Foto maksimal 5 MB',
            'password.string' => 'Password harus berformat string',
            'password.min' => 'Password minimal 5 karakter',
            'password.max' => 'Password maksimal 255 karakter',
            'old_password.max' => 'Password lama maksimal 255 karakter',
            'old_password.string' => 'Password lama harus berformat string',
            'old_password.required_with' => 'Password lama harus diisi!',
        ]);

        if ($validator->fails()) {
            return $this->sendJSONError($validator->errors()->first());
        }

        $user = auth()->user();

        if ($request->has('password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return $this->sendJSONError('Password lama tidak sesuai');
            }

            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;

        if ($request->hasFile('photo') && !empty($request->photo)) {
            $file = $request->file('photo');
            $fileName = \Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatars', $fileName);

            $user->photo = "avatars/{$fileName}";
        }

        $user->save();

        return $this->sendJSONSuccess([
            'username' => $user->username,
            'name' => $user->name,
            'photo' => $user->photo ? Storage::disk('public')->url($user->photo) : asset('assets/img/user.png'),
            'role' => $user->role,
            'is_active' => $user->is_active,
        ], 'successfully update profile');
    }
}
