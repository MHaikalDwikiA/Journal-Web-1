<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipCompany extends Model
{

    protected $fillable = [
        'internship_id',
        'since',
        'sectors',
        'sevices',
        'address',
        'telephone',
        'email',
        'webiste',
        'director',
        'director_phone',
        'advisors',
        'structure',
    ];
}