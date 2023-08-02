<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name',
        'address',
        'director',
        'is_active'
    ];

    function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    function scopeIsInactive($query)
    {
        return $query->where('is_active', false);
    }
}
