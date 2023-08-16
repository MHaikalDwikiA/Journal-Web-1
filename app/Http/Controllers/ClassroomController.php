<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $schoolYears = SchoolYear::all();
        $classrooms = Classroom::query();
        if ($request->has('year') && $request->year !== 'all') {
            $classrooms->where('school_year_id', $request->year);
        }
        $classrooms = $classrooms->get();
        return view('classrooms.index', compact('classrooms', 'schoolYears'));
    }

    public function create()
    {
        $activeSchoolYear = SchoolYear::where('is_active', true)->first();
        $schoolYears = SchoolYear::all();
        return view('classrooms.create', compact('schoolYears', 'activeSchoolYear'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'name' => 'required|string',
            'vocational_program' => 'required|string',
            'vocational_competency' => 'required|string',
        ], [
            'school_year_id.required' => 'Tahun pelajaran harus diisi',
            'name.required' => 'Kelas harus diisi',
            'vocational_program.required' => 'Program keahlian harus diisi',
            'vocational_competency.required' => 'Program kompetensi harus diisi',
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
            'name' => 'required|string',
            'vocational_program' => 'required|string',
            'vocational_competency' => 'required|string',
        ], [
            'school_year_id.required' => 'Tahun pelajaran harus diisi',
            'name.required' => 'Kelas harus diisi',
            'vocational_program.required' => 'Program keahlian harus diisi',
            'vocational_competency.required' => 'Program kompetensi harus diisi',
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
    public function studentIndex($id)
    {
        $classrooms = Classroom::all();
        $availableSchoolYears = SchoolYear::all();
        $students = Student::where('classroom_id', $id)->get();
        $classroom = Classroom::find($id);
        $classroomId = $classroom->id;

        return view('students.index', compact('students', 'classroomId', 'availableSchoolYears', 'classrooms'));
    }

    public function studentCreate($id)
    {
        $classrooms = Classroom::all();
        $schoolYears = SchoolYear::all();
        $classroom = Classroom::find($id);
        $classroomId = $classroom->id;
        return view('students.create', compact('schoolYears', 'classroomId', 'classrooms'));
    }

    public function studentEdit($classroomId, $studentId)
    {
        $classrooms = Classroom::all();
        $classroom = Classroom::find($classroomId);
        $student = Student::find($studentId);
        $schoolYears = SchoolYear::all();
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        return view('students.edit', ['classroomId' => $classroom->id, 'studentId' => $student->id, 'student' => $student, 'classroom' => $classroom, 'schoolYears' => $schoolYears, 'classrooms' => $classrooms]);
    }

    public function studentRemove($classroomId, $studentId)
    {
        $classroom = Classroom::find($classroomId);
        $student = Student::find($studentId);

        $student->delete();

        return redirect()->route('classrooms.studentIndex', $classroom->id);
    }
}
