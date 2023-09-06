<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDraft extends Model
{
    protected $fillable = [
        'student_id',
        'approval_user_id',
        'request_date',
        'approval_date',
        'approval_status',
        'description'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function approvalUser()
    {
        return $this->belongsTo(User::class, 'approval_user_id');
    }
}
