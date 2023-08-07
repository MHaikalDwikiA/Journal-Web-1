<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Classroom;
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
            'identity' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'user_username' => 'required|string|unique:users,username',
            'password_hint' => 'string|max:255',
        ], [
            'identity.required' => 'NIS harus diisi',
            'identity.string' => 'NIS hanya boleh diisi karakter A-Z a-z',
            'identity.max' => 'Maksimal 255 karakter',
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama hanya boleh diisi karakter A-Z a-z',
            'name.max' => 'Maksimal 255 karakter',
            'phone.required' => 'Nomer Telepon harus diisi',
            'gender.required' => 'Jenis kelamin harus diisi',
            'user_username.required' => 'Username harus diisi',
            'user_username.unique' => 'Username sudah digunakan',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->user_username;
        $user->password = bcrypt($request->password_hint);
        $user->role = 'student';
        $user->is_active = 1;
        $user->save();

        $student = new Student();
        $student->school_year_id = $request->school_year_id;
        $student->classroom_id = $request->classroom_id;
        $student->identity = $request->identity;
        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->user_id = $user->id;
        $student->password_hint = $request->password_hint;
        $student->save();

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
