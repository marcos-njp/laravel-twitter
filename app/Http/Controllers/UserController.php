<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(User $user): View
    {
        // Requirement: List all tweets by that user [cite: 81]
        // Eager load likes to prevent N+1 queries
        $tweets = $user->tweets()
            ->with(['user', 'likes'])
            ->withCount('likes')
            ->latest()
            ->get();

        // Requirement: Show total tweet count and total likes received [cite: 82]
        $tweetCount = $tweets->count();
        
        // Logic: Sum up the 'likes_count' of all user's tweets
        $receivedLikesCount = $user->tweets()->withCount('likes')->get()->sum('likes_count');

        return view('users.show', compact('user', 'tweets', 'tweetCount', 'receivedLikesCount'));
    }
}