<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function encounters()
    {
        return $this->hasMany(Encounter::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
