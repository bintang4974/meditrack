<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    // 🔹 Relasi ke site
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function encounters()
    {
        return $this->hasMany(Encounter::class);
    }

    // 🔹 Relasi ke entries (rekam medis pasien)
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
