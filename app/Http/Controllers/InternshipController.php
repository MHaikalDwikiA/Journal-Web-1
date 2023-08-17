<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Company;
use App\Models\CompanyAdvisor;
use Illuminate\Http\Request;
use App\Models\Internship;
use App\Models\SchoolAdvisor;
use App\Models\SchoolYear;
use App\Models\Student;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $schoolYearId = $request->input('school_year_id');
        $classroomId = $request->input('classroom_id');

        $students = Student::when($schoolYearId, function ($query) use ($schoolYearId) {
            $query->where('school_year_id', $schoolYearId);
        })
            ->when($classroomId !== null, function ($query) use ($classroomId) {
                $query->where('classroom_id', $classroomId);
            })
            ->get();

        $companyAdvisors = CompanyAdvisor::all();
        $schoolAdvisors = SchoolAdvisor::all();
        $schoolYears = SchoolYear::all();
        $classes = Classroom::all();
        $companies = Company::all();

        $internships = Student::with('internship')->get();

        return view('internships.index', compact('internships', 'students', 'schoolYears', 'classes', 'companies', 'schoolYearId', 'classroomId', 'companyAdvisors', 'schoolAdvisors'));
    }

    // public function create()
    // {

    //     $companies = Company::all();
    //     return view('internships.create', compact('companies'));
    // }

    public function store(Request $request)
    {
        $data = $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'school_advisor_id' => 'required|exists:school_advisors,id',
            'company_advisor_id' => 'required|exists:company_advisors,id',
            'student_id' => 'required|exists:students,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        $internship = new Internship;
        $internship->student_id = $request->student_id;
        $internship->school_year_id = $request->school_year_id;
        $internship->school_advisor_id = $request->school_advisor_id;
        $internship->company_advisor_id = $request->company_advisor_id;
        $internship->company_id = $request->company_id;
        $internship->save();

        return redirect()->route('internships.index')->with('success', 'Internship berhasil ditambahkan.');
    }

    public function show($id)
    {
        $internships = Internship::with('student')->find($id);

        return view('internships.show', compact('internships'));
    }

    // public function edit(Internship $internship)
    // {
    //     $schoolYears = SchoolYear::all();
    //     $students = Student::all();
    //     $companies = Company::all();
    //     $schoolAdvisors = SchoolAdvisor::all();
    //     $companyAdvisors = CompanyAdvisor::all();

    //     return view('internships.edit', compact('internship', 'schoolYears', 'students', 'companies', 'schoolAdvisors', 'companyAdvisors'));
    // }

    // public function update(Request $request, Internship $internship)
    // {
    //     $data = $request->validate([
    //         'school_year_id' => 'required|exists:school_years,id',
    //         'student_id' => 'required|exists:students,id',
    //         'company_id' => 'required|exists:companies,id',
    //         'school_advisor_id' => 'required|exists:school_advisors,id',
    //         'company_advisor_id' => 'nullable|exists:company_advisors,id',
    //     ]);

    //     $internship->update($data);

    //     return redirect()->route('internships.index')->with('success', 'Internship data updated successfully');
    // }

    // public function remove(Internship $internship)
    // {
    //     $internship->delete();
    //     return redirect()->route('internships.index')->with('success', 'Internship data deleted successfully');
    // }
}
