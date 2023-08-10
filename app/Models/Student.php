<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable =
    [
        'school_year_id',
        'classroom_id',
        'identity',
        'name',
        'user_id',
        'password_hint',

    ];

    public function SchoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
