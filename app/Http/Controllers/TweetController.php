<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TweetController extends Controller
{
    // Display all tweets (Newest first)
    public function index(): View
    {
        // Eager load 'user' and 'likes' to prevent N+1 query performance issues
        // withCount('likes') adds a 'likes_count' attribute to each tweet
            $tweets = Tweet::with(['user', 'likes'])
                ->withCount('likes')
                ->orderByDesc('created_at') // Strict ordering by newest
                ->get();

        return view('tweets.index', compact('tweets'));
    }

    // Store a new tweet
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
              'content' => ['required', 'string', 'max:280'], // Strict 280 char limit
        ]);

        // Create tweet associated with current user
           // Ensure only the validated content is stored, with user_id and timestamp
           $tweet = new \App\Models\Tweet();
           $tweet->content = $validated['content'];
           $tweet->user_id = $request->user()->id;
           $tweet->created_at = now();
           $tweet->save();

        return redirect()->route('tweets.index')->with('success', 'Tweet posted!');
    }

    // Show edit form (Authorization check included)
    public function edit(Tweet $tweet): View
    {
        // Logic: Ensure only the author can view the edit form
        if ($tweet->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tweets.edit', compact('tweet'));
    }

    // Update tweet
    public function update(Request $request, Tweet $tweet): RedirectResponse
    {
        if ($tweet->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:280',
        ]);

        // Only update and mark as edited if content is different
        if ($tweet->content !== $validated['content']) {
            $tweet->update([
                'content' => $validated['content'],
                'is_edited' => true,
            ]);
        }

        return redirect()->route('tweets.index')->with('success', 'Tweet updated successfully!');
    }

    // Delete tweet
    public function destroy(Tweet $tweet): RedirectResponse
    {
        if ($tweet->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to delete this tweet.');
        }

        $tweet->delete(); // Remove from database

        return redirect()->route('tweets.index')->with('success', 'Tweet deleted.');
    }
}