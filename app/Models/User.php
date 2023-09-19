<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'is_active',
        'photo',
        'fcm_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'role' => UserRole::class,
    ];

    function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    function scopeIsInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function companyAdvisor()
    {
        return $this->hasOne(CompanyAdvisor::class);
    }

    public function schoolAdvisor()
    {
        return $this->hasOne(SchoolAdvisor::class);
    }

    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }
}
