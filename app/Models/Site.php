<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];

    // 🔥 FIX: Site hasMany Projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
