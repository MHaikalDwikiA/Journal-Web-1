<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolAdvisor extends Model
{
    protected $fillable = [
        'identity',
        'name',
        'phone',
        'address',
        'gender',
        'is_active',
        'user_id',
        'password_hint'
    ];
    function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    function scopeIsInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
