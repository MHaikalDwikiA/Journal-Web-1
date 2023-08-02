<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::all();
        return view('classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        $schoolYears = SchoolYear::all();
        return view('classrooms.create', compact('schoolYears'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'name' => 'required|string|max:255',
            'vocational_program' => 'required|string|max:255',
            'vocational_competency' => 'required|string|max:255',
        ]);

        Classroom::create($data);

        return redirect()->route('classrooms.index')
            ->with('success', 'Kelas Berhasil Dibuat.');
    }

    public function edit(Classroom $classroom, $id)
    {

        $schoolYears = SchoolYear::all();
        $classroom = Classroom::find($id);
        abort_if(!$classroom, 400, 'Kelas tidak ditemukan');

        return view('classrooms.edit', compact('classroom', 'schoolYears'));
    }

    public function update(Request $request, Classroom $classroom, $id)
    {

        $classroom = Classroom::find($id);
        abort_if(!$classroom, 400, 'Kelas tidak ditemukan');

        $data = $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'name' => 'required|string|max:255',
            'vocational_program' => 'nullable|string|max:255',
            'vocational_competency' => 'nullable|string|max:255',
        ]);

        $classroom->update($data);

        return redirect()->route('classrooms.index')
            ->with('success', 'Kelas Berhasil Diedit.');
    }

    public function remove(Classroom $classroom, $id)
    {

        $classroom = Classroom::find($id);
        abort_if(!$classroom, 400, 'Kelas tidak ditemukan');

        $classroom->delete();

        return redirect()->route('classrooms.index')
            ->with('success', 'Kelas Berhasil Dihapus.');
    }
}
