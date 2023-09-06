<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $fillable = [
        'name',
        'headmaster_name',
        'is_active',
    ];

    public function is_active()
    {
        return $this->attributes['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif';
    }
}
