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
        
        // Optimization: Sum the 'likes_count' from the tweets we already fetched
        $receivedLikesCount = $tweets->sum('likes_count');

        return view('users.show', compact('user', 'tweets', 'tweetCount', 'receivedLikesCount'));
    }
}