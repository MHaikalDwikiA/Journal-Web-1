<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAdvisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'identity',
        'name',
        'phone',
        'address',
        'gender',
        'is_active',
        'user_id',
        'password_hint',
    ];

    function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    function scopeIsInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
