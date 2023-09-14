<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Classroom;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $schoolYears = SchoolYear::all();
        $classrooms = Classroom::query();
        $defaultYearId = SchoolYear::where('is_active', true)->value('id');
        if ($request->has('year')) {
            $classrooms->where('school_year_id', $request->year);
        } else {
            $classrooms->where('school_year_id', $defaultYearId);
        }
        $classrooms = $classrooms->get();
        return view('classrooms.index', compact('classrooms', 'schoolYears', 'defaultYearId'));
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
            'name' => 'required|max:255',
            'vocational_program' => 'required',
            'vocational_competency' => 'required',
        ], [
            'school_year_id.required' => 'Tahun pelajaran harus diisi',
            'name.required' => 'Kelas harus diisi',
            'name.max' => 'Maximal 255 karakter',
            'vocational_program.required' => 'Program keahlian harus diisi',
            'vocational_competency.required' => 'Program kompetensi harus diisi',
        ]);

        Classroom::create($data);

        return redirect()->route('classrooms.index')
            ->with('success', 'Kelas Berhasil Dibuat.');
    }

    public function edit($id)
    {

        $schoolYears = SchoolYear::all();
        $vocationalPrograms = [
            'Teknik Listrik', 'Desain Permodelan dan Informasi Bangunan', 'Rekayasa Perangkat Lunak',
            'Teknik Komputer dan Jaringan', 'Teknik Otomotif', 'Teknik Pemesinan', 'Teknik Elektronika Industri'
        ];
        $vocationalCompetencies = [];
        $classroom = Classroom::find($id);
        abort_if(!$classroom, 400, 'Kelas tidak ditemukan');

        return view('classrooms.edit', compact('classroom', 'schoolYears', 'vocationalCompetencies', 'vocationalPrograms'));
    }

    public function update(Request $request, Classroom $classroom, $id)
    {

        $classroom = Classroom::find($id);
        abort_if(!$classroom, 400, 'Kelas tidak ditemukan');

        $data = $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'name' => 'required|max:255',
            'vocational_program' => 'required',
            'vocational_competency' => 'required',
        ], [
            'school_year_id.required' => 'Tahun pelajaran harus diisi',
            'name.required' => 'Kelas harus diisi',
            'name.max' => 'Maximal 255 karakter',
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

        return view('students.index', compact('students', 'classroomId', 'availableSchoolYears', 'classrooms', 'classroom'));
    }

    public function studentCreate($id)
    {
        $classrooms = Classroom::all();
        $schoolYears = SchoolYear::all();
        $classroom = Classroom::find($id);
        $classroomId = $classroom->id;
        return view('students.create', compact('schoolYears', 'classroomId', 'classrooms', 'classroom'));
    }

    public function studentStore(Request $request, $id)
    {
        $classroom = Classroom::find($id);

        $request->validate([
            'identity' => 'required|max:255|min:5|unique:students,identity|unique:users,username',
            'name' => 'required|max:255',
            'phone' => 'required|max:25|min:5',
            'password_hint' => 'required|max:255|min:5',
        ], [
            'identity.unique' => 'NIS telah dipakai',
            'identity.required' => 'NIS harus diisi',
            'identity.max' => 'Maksimal 255 karakter',
            'identity.min' => 'Minimal 5 karakter',
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Maksimal 255 karakter',
            'phone.required' => 'Nomer telepon harus diisi',
            'phone.max' => 'Maksimal 25 karakter',
            'phone.min' => 'Minimal 5 karakter',
            'password_hint.required' => 'Password harus diisi',
            'password_hint.max' => 'Maksimal 255 karakter',
            'password_hint.min' => 'Minimal 5 karakter',
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

    public function studentEdit($classroomId, $studentId)
    {
        $classrooms = Classroom::all();
        $classroom = Classroom::find($classroomId);
        $student = Student::find($studentId);
        $schoolYears = SchoolYear::all();
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        return view('students.edit', ['classroomId' => $classroom->id, 'studentId' => $student->id, 'student' => $student, 'classroom' => $classroom, 'schoolYears' => $schoolYears, 'classrooms' => $classrooms]);
    }

    public function studentUpdate(Request $request, $id, $classroomId)
    {
        $classroom = Classroom::find($classroomId);
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $request->validate([
            'identity' => 'required|max:255|min:5',
            'name' => 'required|max:255',
            'phone' => 'required|max:25|min:5',
            'password_hint' => 'required|max:255|min:5',
        ], [
            'identity.required' => 'NIS harus diisi',
            'identity.max' => 'Maksimal 255 karakter',
            'identity.min' => 'Minimal 5 karakter',
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Maksimal 255 karakter',
            'phone.required' => 'Nomer telepon harus diisi',
            'phone.max' => 'Maksimal 25 karakter',
            'phone.min' => 'Minimal 5 karakter',
            'password_hint.required' => 'Password harus diisi',
            'password_hint.max' => 'Maksimal 255 karakter',
            'password_hint.min' => 'Minimal 5 karakter',
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

    public function studentRemove($classroomId, $studentId)
    {
        $classroom = Classroom::find($classroomId);
        abort_if(!$classroom, 400, 'Kelas tidak ditemukan');
        $student = Student::find($studentId);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $student->delete();
        $student->user->delete();

        return redirect()->route('classrooms.studentIndex', $classroom->id)->withSuccess('Siswa berhasil dihapus.');
    }

    public function studentImport(Request $request, $classroomId)
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
