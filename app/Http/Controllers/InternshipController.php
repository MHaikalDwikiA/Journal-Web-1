<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Company;
use App\Models\CompanyAdvisor;
use App\Models\SchoolAdvisor;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Internship;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $schoolYearId = $request->input('school_year_id');
        $classroomId = $request->input('classroom_id');

        $studentsQuery = Student::with('internship')
            ->when($schoolYearId, function ($query) use ($schoolYearId) {
                $query->where('school_year_id', $schoolYearId);
            })
            ->when($classroomId !== null, function ($query) use ($classroomId) {
                $query->where('classroom_id', $classroomId);
            });

        $students = $studentsQuery->get();
        $companyAdvisors = CompanyAdvisor::all();
        $schoolAdvisors = SchoolAdvisor::all();
        $schoolYears = SchoolYear::all();
        $classrooms = Classroom::all();
        $companies = Company::all();

        return view('internships.index', compact(
            'students',
            'schoolYears',
            'classrooms',
            'companies',
            'schoolYearId',
            'classroomId',
            'companyAdvisors',
            'schoolAdvisors',
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'school_advisor_id' => 'required|exists:school_advisors,id',
            'company_advisor_id' => 'required|exists:company_advisors,id',
            'student_id' => 'required|exists:students,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        $internship = new Internship($request->only([
            'school_year_id',
            'school_advisor_id',
            'company_advisor_id',
            'student_id',
            'company_id',
        ]));
        $internship->save();

        return redirect()->route('internships.index')->with('success', 'Internship berhasil ditambahkan.');
    }

    public function show($id)
    {
        $internship = Internship::with(
            'student',
            'internshipCompany',
            'companyJobTitles',
            'companyEmployees',
            'competencies',
            'equipments',
            'suggestions',
            'companyRules'
        )->find($id);

        return view('internships.show', compact('internship'));
    }
}
