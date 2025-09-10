<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    protected $guarded = [];

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}
