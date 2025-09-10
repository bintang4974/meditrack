<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects')
            ->withPivot('role_in_project')
            ->withTimestamps();
    }

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }
}
