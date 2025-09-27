<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $guarded = [];

    public function entries()
    {
        return $this->belongsToMany(Entry::class, 'entry_label');
    }
}
