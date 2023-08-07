<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CompanyAdvisor;

class CompanyAdvisorController extends Controller
{
    public function index(Request $request)
    {
        $isInactive = $request->view == 'inactive';

        $activeCount = CompanyAdvisor::isActive()->count();
        $inactiveCount = CompanyAdvisor::isInactive()->count();

        $query = CompanyAdvisor::query();

        if ($isInactive) {
            $query->isInactive();
        } else {
            $query->isActive();
        }

        $advisors = $query->get();

        return view('company-advisors.index', compact('activeCount', 'inactiveCount', 'advisors'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('company-advisors.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'company_id' => 'required|exists:companies,id',
                'identity' => 'required|max:255|unique:company_advisors,identity',
                'name' => 'required|max:255',
                'phone' => 'required|max:255',
                'gender' => 'required',
                'is_active' => 'required',
                'password_hint' => 'required',
            ],
            [
                'identity.required' => 'NIP harus diisi!',
                'identity.max' => 'Maksimal 255 karakter!',
                'identity.unique' => 'NIP sudah digunakan!',
                'is_active.required' => 'Status harus diisi!',
                'name.required' => 'Nama harus diisi!',
                'name.max' => 'Maksimal 255 karakter!',
                'phone.required' => 'No HP harus diisi!',
                'phone.max' => 'Maksimal 255 karakter!',

                'gender.required' => 'Jenis kelamin harus diisi!',
                'password_hint.required' => 'Password harus diisi!',
            ]
        );
        $advisor = new CompanyAdvisor;

        $advisor->company_id = $request->company_id;
        $advisor->identity = $request->identity;
        $advisor->name = $request->name;
        $advisor->phone = $request->phone;
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

        return redirect()->route('company-advisors.index')->withSuccess('Pembimbing perusahaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $companies = Company::all();
        $advisor = CompanyAdvisor::find($id);
        $users = User::all();
        abort_if(!$advisor, 400, 'Pembimbing perusahaan tidak ditemukan');

        return view('company-advisors.edit', compact('advisor', 'companies', 'users'));
    }

    public function update(Request $request, $id)
    {
        $advisor = CompanyAdvisor::find($id);
        abort_if(!$advisor, 400, 'Pembimbing perusahaan tidak ditemukan');

        $validate = $request->validate(
            [
                'company_id' => 'required|exists:companies,id',
                'identity' => 'required|max:255',
                'name' => 'required|max:255',
                'phone' => 'required|max:255',
                'gender' => 'required',
                'is_active' => 'required',
                'password_hint' => 'required',
            ],
            [
                'identity.required' => 'NIP harus diisi!',
                'is_active.required' => 'Status harus diisi!',
                'identity.max' => 'Maksimal 255 karakter!',
                'name.required' => 'Nama harus diisi!',
                'name.max' => 'Maksimal 255 karakter!',
                'phone.required' => 'No HP harus diisi!',
                'phone.max' => 'Maksimal 255 karakter!',

                'gender.required' => 'Jenis kelamin harus diisi!',
                'password_hint.required' => 'Password harus diisi!',
            ]
        );

        $advisor->update($validate);

        return redirect()->route('company-advisors.index')->withSuccess('Pembimbing perusahaan berhasil diubah');
    }

    public function remove($id)
    {
        $advisor = CompanyAdvisor::find($id);
        abort_if(!$advisor, 400, 'Pembimbing perusahaan tidak ditemukan');

        $advisor->delete();

        return redirect()->route('company-advisors.index')->withSuccess('Pembimbing perusahaan berhasil dihapus');
    }
}