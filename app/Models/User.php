<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'role',

    // ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'user_projects')
            ->withPivot('role_in_project')
            ->withTimestamps();
    }

    public function isPro()
    {
        return $this->membership === 'pro' && $this->subscription_ends_at && now()->lt($this->subscription_ends_at);
    }

    public function isFree()
    {
        return $this->membership === 'free' || !$this->isPro();
    }

    public function isExpiredPro()
    {
        return $this->membership === 'pro' && $this->subscription_ends_at && now()->gt($this->subscription_ends_at);
    }
}
