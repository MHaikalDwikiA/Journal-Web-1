<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Student = 'student';
    case SchoolAdvisor = 'school_advisor';
    case CompanyAdvisor = 'company_advisor';
}
