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

    function scopeIsPending($query)
    {
        return $query->where('approval_status', 'Menunggu Persetujuan');
    }

    function scopeIsApproved($query)
    {
        return $query->where('approval_status', 'Terima');
    }

    function scopeIsReject($query)
    {
        return $query->where('approval_status', 'Tolak');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function approvalUser()
    {
        return $this->belongsTo(User::class, 'approval_user_id');
    }
}
