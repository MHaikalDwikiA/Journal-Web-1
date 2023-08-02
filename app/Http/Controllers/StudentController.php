<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\User;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\SchoolYear;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $users = User::where('role', 'student')->get();
        $classrooms = Classroom::all();
        $schoolYears = SchoolYear::all();
        $hashed_random_password = Str::random(6);
        return view('students.create', compact('classrooms', 'schoolYears', 'users', 'hashed_random_password'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'identity' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'password_hint' => 'string|max:255',
        ]);

        $student = new Student();
        $student->school_year_id = $request->school_year_id;
        $student->classroom_id = $request->classroom_id;
        $student->identity = $request->identity;
        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->user_id = $request->user_id;
        if ($request->password) {
            $student->password = bcrypt($request->password);
        }
        $student->save();

        return redirect()->route('students.index')
            ->with('success', 'Siswa berhasil dibuat.');
    }

    public function edit(Student $student, $id)
    {
        $classrooms = Classroom::all();
        $schoolYears = SchoolYear::all();
        $users = User::all();
        $student = Student::find($id);
        $hashed_random_password = Str::random(6);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        return view('students.edit', compact('student', 'classrooms', 'schoolYears', 'users', 'hashed_random_password'));
    }

    public function update(Request $request, Student $student, $id)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'identity' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'password_hint' => 'string|max:255',
        ]);

        $student = new Student();
        $student->school_year_id = $request->school_year_id;
        $student->classroom_id = $request->classroom_id;
        $student->identity = $request->identity;
        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->user_id = $request->user_id;
        if ($request->password) {
            $student->password = bcrypt($request->password);
        }
        $student->save();

        return redirect()->route('students.index')
            ->with('success', 'Siswa berhasil diedit.');
    }

    public function remove(Student $student, $id)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Siswa berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:xls,xlsx'
        ]);

        try {
            Excel::import(new StudentsImport, $request->file('import_file'));
            return redirect()->route('students.index')->with('success', 'Data siswa berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'Terjadi kesalahan saat mengimpor data siswa.');
        }
    }
}
