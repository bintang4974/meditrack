<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    // 🔹 Relasi ke user (owner project)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // 🔹 Relasi ke user_projects (anggota project)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects')
            ->withPivot('role_in_project')
            ->withTimestamps();
    }

    // 🔹 Relasi ke sites (1 project punya banyak site)
    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    // 🔹 Relasi ke entries (1 project bisa punya banyak entries via pasien)
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function joinRequests()
    {
        return $this->hasMany(ProjectJoinRequest::class);
    }
}
