<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectJoinRequest extends Model
{
    protected $guarded = [];

    // Relasi ke Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke User yang melakukan request join
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
