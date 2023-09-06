<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SchoolAdvisor;

class SchoolAdvisorController extends Controller
{
    public function index(Request $request)
    {
        $isInactive = $request->view == 'inactive';

        $activeCount = SchoolAdvisor::isActive()->count();
        $inactiveCount = SchoolAdvisor::isInactive()->count();

        $query = SchoolAdvisor::query();

        if ($isInactive) {
            $query->isInactive();
        } else {
            $query->isActive();
        }

        $advisors = $query->get();

        return view('school-advisors.index', compact('activeCount', 'inactiveCount', 'advisors'));
    }

    public function create()
    {
        return view('school-advisors.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'identity' => 'required|max:255|min:5|unique:school_advisors,identity|unique:users,username',
                'name' => 'required|max:255',
                'phone' => 'required|max:25|min:5',
                'address' => 'required|max:255',
                'gender' => 'required',
                'is_active' => 'required|boolean',
                'password_hint' => 'required|min:5|max:255',
            ],
            [
                'identity.required' => 'NIP harus diisi!',
                'identity.max' => 'Maksimal 255 karakter!',
                'identity.min' => 'Minimal 5 karakter!',
                'identity.unique' => 'NIP sudah digunakan!',
                'name.required' => 'Nama harus diisi!',
                'name.max' => 'Maksimal 255 karakter!',
                'phone.required' => 'No HP harus diisi!',
                'phone.max' => 'Maksimal 25 karakter!',
                'phone.min' => 'Minimal 5 karakter!',
                'address.required' => 'Alamat harus diisi!',
                'address.max' => 'Maksimal 255 karakter!',
                'gender.required' => 'Jenis kelamin harus diisi!',
                'is_active.required' => 'Status harus diisi!',
                'is_active.boolean' => 'Status hanya boleh diisi aktif / tidak aktif!',
                'password_hint.required' => 'Password harus diisi!',
                'password_hint.min' => 'Minimal 5 karaker!',
                'password_hint.max' => 'Maksimal 255 karakter!'
            ]
        );
        $advisor = new SchoolAdvisor;

        $advisor->identity = $request->identity;
        $advisor->name = $request->name;
        $advisor->phone = $request->phone;
        $advisor->address = $request->address;
        $advisor->gender = $request->gender;
        $advisor->is_active = $request->is_active;
        $advisor->password_hint = $request->password_hint;

        $user = new User;
        $user->name = $advisor->name;
        $user->username = $advisor->identity;
        $user->password = bcrypt($advisor->password_hint);
        $user->role = 'school_advisor';
        $user->is_active = 1;
        $user->save();

        $advisor->user_id = $user->id;
        $advisor->save();

        return redirect()->route('school-advisors.index')->withSuccess('Pembimbing Sekolah berhasil ditambahkan');
    }

    public function edit($id)
    {
        $advisor = SchoolAdvisor::find($id);
        abort_if(!$advisor, 400, 'Pembimbing sekolah tidak ditemukan');

        return view('school-advisors.edit', compact('advisor'));
    }

    public function update(Request $request, $id)
    {
        $advisor = SchoolAdvisor::find($id);
        abort_if(!$advisor, 400, 'Pembimbing sekolah tidak ditemukan');

        $validate = $request->validate(
            [
                'identity' => 'required|max:255|min:5',
                'name' => 'required|max:255',
                'phone' => 'required|max:25|min:5',
                'address' => 'required|max:255',
                'gender' => 'required',
                'is_active' => 'required|boolean',
                'password_hint' => 'required|min:5|max:255',
            ],
            [
                'identity.required' => 'NIP harus diisi!',
                'identity.max' => 'Maksimal 255 karakter!',
                'identity.min' => 'Minimal 5 karakter!',
                'identity.unique' => 'NIP sudah digunakan!',
                'name.required' => 'Nama harus diisi!',
                'name.max' => 'Maksimal 255 karakter!',
                'phone.required' => 'No HP harus diisi!',
                'phone.max' => 'Maksimal 25 karakter!',
                'phone.min' => 'Minimal 5 karakter!',
                'address.required' => 'Alamat harus diisi!',
                'address.max' => 'Maksimal 255 karakter!',
                'gender.required' => 'Jenis kelamin harus diisi!',
                'is_active.required' => 'Status harus diisi!',
                'is_active.boolean' => 'Status hanya boleh diisi aktif / tidak aktif!',
                'password_hint.required' => 'Password harus diisi!',
                'password_hint.min' => 'Minimal 5 karaker!',
                'password_hint.max' => 'Maksimal 255 karakter!'
            ]
        );

        $user = $advisor->user;
        $user->name = $request->name;
        $user->username = $request->identity;
        $user->password = bcrypt($request->password_hint);
        $user->save();

        $advisor->identity = $request->identity;
        $advisor->name = $request->name;
        $advisor->phone = $request->phone;
        $advisor->address = $request->address;
        $advisor->gender = $request->gender;
        $advisor->is_active = $request->is_active;
        $advisor->password_hint = $request->password_hint;
        $advisor->save();

        $advisor->update($validate);

        return redirect()->route('school-advisors.index')->withSuccess('Pembimbing Sekolah berhasil diubah');
    }

    public function remove($id)
    {
        $advisor = SchoolAdvisor::find($id);
        abort_if(!$advisor, 400, 'Pembimbing sekolah tidak ditemukan');

        $advisor->delete();
        $advisor->user->delete();

        return redirect()->route('school-advisors.index')->withSuccess('Pembimbing Sekolah berhasil dihapus');
    }
}
