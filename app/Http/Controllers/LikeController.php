<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Tweet $tweet): RedirectResponse
    {
        // REQUIREMENT: Users can unlike tweets they've previously liked
        // Check if the current user has already liked this specific tweet
        $existingLike = $tweet->likes()->where('user_id', Auth::id())->first();

        if ($existingLike) {
            // If yes, delete it (Unlike)
            $existingLike->delete();
        } else {
            // REQUIREMENT: Users can like any tweet
            // REQUIREMENT: One user can only like a tweet once (Database prevents duplicates, this logic creates the first one)
            $tweet->likes()->create([
                'user_id' => Auth::id(),
            ]);
        }

        // REQUIREMENT: Updates without full page refresh (Bonus) - strictly speaking this is a refresh (back), 
        // but it returns user to exact scroll position.
        return back();
    }
}
