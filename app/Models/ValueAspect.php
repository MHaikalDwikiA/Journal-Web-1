<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueAspect extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_id',
        'assessment_aspect_id',
        'value_with_numbers',
        'value_with_letters',
        'verification',
    ];

    public function internship()
    {
        return $this->belongsTo(Internship::class, 'internship_id');
    }

    public function assessmentAspect()
    {
        return $this->belongsTo(AssessmentAspect::class, 'assessment_aspect_id');
    }
}
