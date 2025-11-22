<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use SoftDeletes; // Enables restoring deleted tweets if needed

    protected $fillable = [
        'user_id',
        'content',
        'is_edited',
        'likes_count', // We will keep this updated for performance
    ];

    // RELATIONSHIPS

    // A tweet belongs to one user (author)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // A tweet can have many likes
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    // LOGIC HELPERS

    // Check if a specific user liked this tweet (returns true/false)
    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
