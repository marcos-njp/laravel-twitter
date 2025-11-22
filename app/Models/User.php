<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio', // Added for future profile feature
        'avatar', // Added for future profile feature
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELATIONSHIPS

    // A user can have many tweets
    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class)->latest(); // Orders by newest first automatically
    }

    // A user can have many likes
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}
