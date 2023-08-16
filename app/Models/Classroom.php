<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classroom extends Model
{
    protected $table = 'classrooms';

    protected $fillable = [
        'school_year_id',
        'name',
        'vocational_program',
        'vocational_competency',
    ];

    /**
     * Get all of the comments for the Classroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }
}
