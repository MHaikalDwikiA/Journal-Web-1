<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = [
        'school_year_id',
        'student_id',
        'company_id',
        'school_advisor_id',
        'company_advisor_id',
        'working_day'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function journals()
    {
        return $this->hasMany(InternshipJournal::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function schoolAdvisor()
    {
        return $this->belongsTo(SchoolAdvisor::class);
    }

    public function companyAdvisor()
    {
        return $this->belongsTo(CompanyAdvisor::class);
    }

    public function internshipCompany()
    {
        return $this->hasOne(InternshipCompany::class, 'internship_id');
    }

    public function companyJobTitles()
    {
        return $this->hasMany(InternshipCompanyJobTitle::class);
    }

    public function companyEmployees()
    {
        return $this->hasMany(InternshipCompanyEmployee::class);
    }

    public function competencies()
    {
        return $this->hasMany(InternshipCompetency::class);
    }

    public function equipments()
    {
        return $this->hasMany(InternshipEquipment::class);
    }

    public function suggestions()
    {
        return $this->hasMany(InternshipSuggestion::class);
    }

    public function companyRules()
    {
        return $this->hasMany(InternshipCompanyRule::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
