<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'identity',
        'name',
        'phone',
        'birth_date',
        'birth_place',
        'religion',
        'gender',
        'address',
        'photo',
        'blood_type',
        'parent_name',
        'parent_phone',
        'parent_address',
        'password_hint',
        'school_year_id',
        'classroom_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function internship()
    {
        return $this->hasOne(Internship::class, 'student_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
