<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $school = School::latest()->first();

        return view('school.index', compact('school'));
    }

    public function edit($id)
    {
        $school = School::find($id);
        abort_if(!$school, 400, 'School tidak ditemukan');

        return view('school.edit', compact('school'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required:max:255',
                'npsn' => 'required:max:255',
                'address' => 'required:max:255',
                'kelurahan' => 'required:max:255',
                'kecamatan' => 'required:max:255',
            ],
            [
                'name.required' => 'Nama harus diisi!',
                'npsn.required' => 'NPSN harus diisi!',
                'address.required' => 'Alamat harus diisi!',
                'kelurahan.required' => 'kelurahan harus diisi!',
                'kecamatan.required' => 'Kecamatan harus diisi!',
                'address.max' => 'Maksimal 255 karakter!',
                'name.max' => 'Maksimal 255 karakter!',
                'npsn.max' => 'Maksimal 255 karakter!',
                'kelurahan.max' => 'Maksimal 255 karakter!',
                'kecamatan.max' => 'Maksimal 255 karakter!',
            ]
        );

        $school = School::find($id);

        $school->name = $request->name;
        $school->npsn = $request->npsn;
        $school->address = $request->address;
        $school->kelurahan = $request->kelurahan;
        $school->kecamatan = $request->kecamatan;

        $school->save();

        return redirect()->route('school.index')->withSuccess('Sekolah berhasil diubah!');
    }
}
