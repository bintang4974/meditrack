<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];

    // 🔹 Relasi ke project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // 🔹 Relasi ke doctors (jika dokter ditugaskan di site ini)
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    // 🔹 Relasi ke patients (1 site punya banyak pasien)
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
