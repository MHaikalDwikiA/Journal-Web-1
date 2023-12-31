<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipJournal extends Model
{
    protected $fillable = [
        'internship_id',
        'date',
        'activity',
        'activity_image',
        'competency_id',
        'approval_user_id',
        'approval_by',
        'approval_at',
    ];

    public function internship()
    {
        return $this->belongsTo(Internship::class, 'internship_id');
    }

    public function competency()
    {
        return $this->belongsTo(InternshipCompetency::class, 'competency_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'approval_user_id');
    }
}
