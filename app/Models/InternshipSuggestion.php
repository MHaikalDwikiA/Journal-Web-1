<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipSuggestion extends Model
{
    protected $fillable = [
        'internship_id',
        'company_employee_id',
        'suggest',
        'approval_user_id',
        'approval_by',
        'approval_at'
    ];

    public function employees()
    {
        return $this->belongsTo(InternshipCompanyEmployee::class, 'company_employee_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'approval_user_id');
    }
}
