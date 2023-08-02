<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable =
    [
        'identity',
        'name',
        'gender',
        'phone',
        'user_id',
        'password_hint',

    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
