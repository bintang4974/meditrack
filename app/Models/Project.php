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

    // 🔥 FIX: Project belongsTo Site
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class, 'project_id');
    }
}
