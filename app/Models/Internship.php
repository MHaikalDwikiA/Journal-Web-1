<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function SchoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function Student()
    {
        return $this->hasMany(Student::class);
    }

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }

    public function SchoolAdvisor()
    {
        return $this->belongsTo(SchoolAdvisor::class);
    }

    public function CompanyAdvisor()
    {
        return $this->belongsTo(CompanyAdvisor::class);
    }
}
