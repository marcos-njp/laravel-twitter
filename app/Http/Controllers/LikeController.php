<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    // Toggle Like/Unlike
    public function store(Tweet $tweet): RedirectResponse
    {
        // Check if the user already liked the tweet
        $existingLike = $tweet->likes()->where('user_id', Auth::id())->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
        } else {
            // Like (Create relationship)
            $tweet->likes()->create([
                'user_id' => Auth::id(),
            ]);
        }

        return back(); // Returns to the same scroll position
    }
}
