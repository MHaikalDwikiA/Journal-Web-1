<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $isInactive = $request->view == 'inactive';

        $activeCount = Company::isActive()->count();
        $inactiveCount = Company::isInactive()->count();

        $query = Company::query();

        if ($isInactive) {
            $query->isInactive();
        } else {
            $query->isActive();
        }

        $companies = $query->get();

        return view('company.index', compact('companies', 'activeCount', 'inactiveCount'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'address' => 'required|max:255|min:5',
                'director' => 'required|max:255|min:5',
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Nama harus diisi!',
                'name.max' => 'Maksimal 255 karakter!',
                'address.required' => 'Alamat harus diisi!',
                'address.max' => 'Maksimal 255 karakter!',
                'address.min' => 'Minimal 5 karakter!',
                'director.required' => 'Direktur perusahaan harus diisi!',
                'director.max' => 'Maksimal 255 karakter!',
                'director.min' => 'Minimal 5 karakter!',
                'is_active.required' => 'Status harus diisi!',
                'is_active.boolean' => 'Status hanya boleh diisi aktif / tidak aktif!'
            ]
        );

        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'director' => $request->director,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('companies.index')->withSuccess('Perusahaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $company = Company::find($id);
        abort_if(!$company, 400, 'Perusahaan tidak ditemukan');

        return view('company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        abort_if(!$company, 400, 'Perusahaan tidak ditemukan');

        $request->validate(
            [
                'name' => 'required|max:255',
                'address' => 'required|max:255|min:5',
                'director' => 'required|max:255|min:5',
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Nama harus diisi!',
                'name.max' => 'Maksimal 255 karakter!',
                'address.required' => 'Alamat harus diisi!',
                'address.max' => 'Maksimal 255 karakter!',
                'address.min' => 'Minimal 5 karakter!',
                'director.required' => 'Direktur perusahaan harus diisi!',
                'director.max' => 'Maksimal 255 karakter!',
                'director.min' => 'Minimal 5 karakter!',
                'is_active.required' => 'Status harus diisi!',
                'is_active.boolean' => 'Status hanya boleh diisi aktif / tidak aktif!'
            ]
        );

        $company->name = $request->name;
        $company->address = $request->address;
        $company->director = $request->director;
        $company->is_active = $request->is_active;
        $company->save();

        return redirect()->route('companies.index')->withSuccess('Perusahaan berhasil diubah!');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        abort_if(!$company, 400, 'Perusahaan tidak ditemukan');

        $company->delete();
        return redirect()->route('companies.index')->withSuccess('Perusahaan berhasil dihapus!');
    }
}
