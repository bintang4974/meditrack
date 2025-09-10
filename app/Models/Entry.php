<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $guarded = [];

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Doctor::class, 'entry_supervisor');
    }

    public function metadata()
    {
        return $this->hasMany(Metadata::class);
    }
}
