<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipCompanyJobTitle extends Model
{
    protected $fillable = [
        'internship_id',
        'name',
        'description'
    ];
}