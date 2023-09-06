<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipRule extends Model
{
    protected $fillable = [
        'id',
        'school_year_id',
        'sequence',
        'description'
    ];
}