<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Classroom;
use App\Models\Internship;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\User;
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
        $students = Student::all();
        $schoolYears = SchoolYear::all();
        $classrooms = Classroom::all();
        $users = User::all();
        return view('students.create', compact('students', 'schoolYears', 'classrooms', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'identity' => 'required|string|max:255|unique:students,identity',
            'name' => 'required|string|max:255',
            'password_hint' => 'required|max:255',
        ], [
            'classroom_id.required' => 'Kelas harus diisi',
            'identity.unique' => 'NIS telah dipakai',
            'identity.required' => 'NIS harus diisi',
            'identity.string' => 'NIS hanya boleh diisi karakter A-Z a-z',
            'identity.max' => 'Maksimal 255 karakter',
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama hanya boleh diisi karakter A-Z a-z',
            'name.max' => 'Maksimal 255 karakter',
            'password_hint.required' => 'Password harus diisi',
        ]);

        $student = new Student();
        $student->school_year_id = $request->school_year_id;
        $student->classroom_id = $request->classroom_id;
        $student->identity = $request->identity;
        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->password_hint = $request->password_hint;

        $user = new User();
        $user->name = $student->name;
        $user->username = $student->identity;
        $user->password = bcrypt($student->password_hint);
        $user->role = 'student';
        $user->is_active = 1;
        $user->save();

        $student->user_id = $user->id;
        $student->save();

        $internship = new Internship();
        $internship->student_id = $student->id;
        $internship->school_year_id = $student->school_year_id;
        $internship->save();

        return redirect()->route('students.index')->withSuccess('Siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $classrooms = Classroom::all();
        $users = User::where('role', 'student')->get();
        $schoolYears = SchoolYear::all();
        $student = Student::find($id);
        abort_if(!$student, 400, 'Student not found');

        return view('students.edit', compact('student', 'classrooms', 'schoolYears', 'users'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Student not found');

        $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'identity' => 'required|string|max:255|unique:students,id',
            'name' => 'required|string|max:255',
            'password_hint' => 'required',
        ], [
            'identity.required' => 'NIS harus diisi',
            'identity.max' => 'NIS maksimal 255 karakter',
            'identity.unique' => 'NIS sudah digunakan',
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'phone.required' => 'Nomer Telepon harus diisi'
        ]);

        $student->school_year_id = $request->school_year_id;
        $student->classroom_id = $request->classroom_id;
        $student->identity = $request->identity;
        $student->name = $request->name;
        $student->password_hint = $request->password_hint;
        $student->save();



        return redirect()->route('students.index')->withSuccess('Siswa Berhasil ditambahkan');
    }

    public function remove($id)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Student not found');

        $student->delete();

        return redirect()->route('students.index')
            ->withSuccess('Student deleted successfully.');
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
            return redirect()->route('students.index')->with('error', 'Terjadi kesalahan saat mengimpor data siswa.' . $e->getMessage());
        }
    }
}
