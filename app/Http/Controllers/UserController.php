<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(User $user)
    {
        // 1. Calculate Stats
        $tweetCount = $user->tweets()->count();
        $receivedLikesCount = $user->tweets()->withCount('likes')->get()->sum('likes_count');

        // 2. Check which tab we are on (Default to 'tweets')
        $tab = request()->query('tab', 'tweets');

        if ($tab === 'likes') {
            // Fetch tweets where the 'likes' relationship contains this user
            $tweets = \App\Models\Tweet::whereHas('likes', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->with(['user', 'likes'])
                ->withCount('likes')
                ->latest() // Order by when the tweet was created (standard)
                ->get();
        } else {
            // Fetch user's own tweets
            $tweets = $user->tweets()
                ->with(['user', 'likes'])
                ->withCount('likes')
                ->latest()
                ->get();
        }

        return view('users.show', compact('user', 'tweets', 'tweetCount', 'receivedLikesCount', 'tab'));
    }
}
