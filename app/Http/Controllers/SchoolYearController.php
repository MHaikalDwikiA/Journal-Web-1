<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolYearController extends Controller
{

    public function index(Request $request)
    {
        $query = SchoolYear::query();
        $school_years = $query->orderBy('is_active', 'desc')->get();

        return view('school-years.index', compact('school_years'));
    }

    public function create()
    {
        $query = SchoolYear::query();
        $school_years = $query->get();
        return view('school-years.create', compact('school_years'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:school_years',
            'headmaster_name' => 'required|max:255',
            'is_active' => 'required|boolean',
        ],  [
            'name.required' => 'Tahun pelajaran harus diisi!',
            'name.unique' => 'Tahun pelajaran telah digunakan!',
            'headmaster_name.required' => 'Nama Kepala sekolah harus diisi!',
            'headmaster_name.max' => 'Nama Kepala sekolah tidak boleh lebih dari 255 karakter.',
            'is_active.required' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi aktif / tidak aktif!',
        ]);

        DB::beginTransaction();

        try {
            if ($data['is_active']) {
                // Deactivate all other active SchoolYear records
                SchoolYear::where('is_active', true)->update(['is_active' => false]);
            }

            SchoolYear::create($data);

            DB::commit();

            return redirect()->route('school-years.index')->withSuccess('Tahun Pelajaran berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['message' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function edit($id)
    {
        $schoolYear = SchoolYear::find($id);
        abort_if(!$schoolYear, 400, 'Tahun Pelajaran tidak ditemukan');

        return view('school-years.edit', compact('schoolYear'));
    }

    public function update($id, Request $request)
    {
        $schoolYear = SchoolYear::find($id);
        abort_if(!$schoolYear, 400, 'Tahun Pelajaran tidak ditemukan');

        $data = $request->validate([
            'name' => 'required',
            'headmaster_name' => 'required|max:255',
            'is_active' => 'boolean',
        ], [
            'name.required' => 'Tahun harus diisi!',
            'headmaster_name.required' => 'Nama Kepala Sekolag harus diisi!',
            'headmaster_name.max' => 'Nama kepala sekolah tidak boleh lebih dari 255 karakter.',
            'is_active.boolean' => 'Status hanya boleh diisi aktif / tidak aktif!',
        ]);

        DB::beginTransaction();

        try {
            if ($data['is_active']) {
                SchoolYear::where('is_active', true)->where('id', '!=', $schoolYear->id)->update(['is_active' => false]);
            }

            $schoolYear->update($data);

            DB::commit();

            return redirect()->route('school-years.index')->withSuccess('Tahun Pelajaran berhasil diedit.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['message' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function remove(SchoolYear $schoolYear, $id)
    {
        $schoolYear = SchoolYear::find($id);
        abort_if(!$schoolYear, 400, 'Tahun Pelajaran tidak ditemukan');

        $schoolYear->delete();

        return redirect()->route('school-years.index')->withSucces('Tahun Pelajaran berhasil dihapus.');
    }

    // public function deactivate($id)
    // {
    //     $schoolYear = SchoolYear::find($id);
    //     abort_if(!$schoolYear, 400, 'Tahun Pelajaran tidak ditemukan');

    //     $schoolYear->update(['is_active' => false]);

    //     return redirect()->route('school-years.index')->withSuccess('Tahun Pelajaran berhasil dinonaktifkan.');
    // }

    // public function activate($id)
    // {
    //     $schoolYear = SchoolYear::find($id);
    //     abort_if(!$schoolYear, 400, 'Tahun Pelajaran tidak ditemukan');

    //     // Deactivate other school years
    //     SchoolYear::where('id', '<>', $schoolYear->id)->update(['is_active' => false]);

    //     $schoolYear->update(['is_active' => true]);

    //     return redirect()->route('school-years.index')->withSuccess('Tahun Pelajaran berhasil diaktifkan.');
    // }
}
