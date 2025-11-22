<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Tweet $tweet)
    {
        $user = Auth::user();
        $existingLike = $tweet->likes()->where('user_id', $user->id)->first();
        $liked = false;

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            $tweet->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        // Check if request is AJAX (JavaScript)
        if (request()->wantsJson()) {
            return response()->json([
                'liked' => $liked,
                'count' => $tweet->likes()->count(),
            ]);
        }

        return back();
    }
}
