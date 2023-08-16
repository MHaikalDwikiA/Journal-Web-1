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
    public function index(Request $request)
    {
        $classrooms = Classroom::all();
        $availableSchoolYears = SchoolYear::all();
        $students = Student::query();
        if ($request->has('classrooms') && $request->classrooms !== 'all') {
            $students->where('classroom_id', $request->classrooms);
        }
        $students = $students->get();
        return view('classrooms.studentIndex', compact('students', 'availableSchoolYears', 'classrooms'));
    }

    public function create($id)
    {
        $classroom = Classroom::find($id);
        $schoolYears = SchoolYear::all();
        $classroomId = $classroom->id;
        return view('students.create', compact('schoolYears', 'classroom'));
    }

    public function store(Request $request, $id)
    {
        $classroom = Classroom::find($id);

        $request->validate([
            'identity' => 'required|string|max:255|unique:students,identity',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'password_hint' => 'required|max:255',
        ], [
            'identity.unique' => 'NIS telah dipakai',
            'identity.required' => 'NIS harus diisi',
            'identity.string' => 'NIS hanya boleh diisi karakter A-Z a-z',
            'identity.max' => 'NIS maksimal 255 karakter',
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama hanya boleh diisi karakter A-Z a-z',
            'name.max' => 'Nama maksimal 255 karakter',
            'phone.max' => 'Nomer telepon maksimal 25 karakter',
            'password_hint.required' => 'Password harus diisi',
            'password_hint.max' => 'Password Maksimal 155'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->identity;
        $user->password = bcrypt($request->password_hint);
        $user->role = 'student';
        $user->is_active = 1;
        $user->save();

        $student = new Student();
        $student->school_year_id = $classroom->school_year_id;
        $student->classroom_id = $classroom->id;
        $student->identity = $request->identity;
        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->password_hint = $request->password_hint;
        $student->user_id = $user->id;
        $student->save();

        return redirect()->route('classrooms.studentIndex', $classroom->id)->withSuccess('Siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $classrooms = Classroom::all();
        $schoolYears = SchoolYear::all();
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        return view('students.edit', compact('student', 'classrooms', 'schoolYears'));
    }

    public function update(Request $request, $id, $classroomId)
    {
        $classroom = Classroom::find($classroomId);
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $request->validate([
            'identity' => 'required|string|max:255|unique:students,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'password_hint' => 'required',
        ], [
            'identity.required' => 'NIS harus diisi',
            'identity.max' => 'NIS maksimal 255 karakter',
            'identity.unique' => 'NIS sudah digunakan',
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'phone.max' => 'Nomer Telepon maksimal 25 karakter',
            'phone.required' => 'Nomer Telepon harus diisi'
        ]);

        $user = $student->user;
        $user->name = $request->name;
        $user->username = $request->identity;
        $user->password = bcrypt($request->password_hint);
        $user->save();

        $student->identity = $request->identity;
        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->password_hint = $request->password_hint;
        $student->save();

        return redirect()->route(
            'classrooms.studentIndex',
            $classroom->id
        )->withSuccess('Siswa Berhasil diedit');
    }

    public function remove($id)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $student->delete();

        return redirect()->route('students.index')
            ->withSuccess('Siswa berhasil dihapus.');
    }

    public function import(Request $request, $classroomId)
    {
        $classroom = Classroom::find($classroomId);

        $request->validate([
            'import_file' => 'required|mimes:xls,xlsx'
        ]);

        try {
            Excel::import(new StudentsImport($classroom), $request->file('import_file'));
            return redirect()->route('classrooms.studentIndex', $classroom->id)->with('success', 'Data siswa berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->route('classrooms.studentIndex', $classroom->id)->with('error', 'Terjadi kesalahan saat mengimpor data siswa.' . $e->getMessage());
        }
    }
}
