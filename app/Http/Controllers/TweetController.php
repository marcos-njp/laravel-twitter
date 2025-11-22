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
        $tweets = Tweet::with('user', 'likes')
            ->withCount('likes')
            ->latest()
            ->get();

        return view('tweets.index', compact('tweets'));
    }

    // Store a new tweet
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:280',
        ]);

        // Create tweet associated with current user
        $request->user()->tweets()->create($validated);

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

        $tweet->update([
            'content' => $validated['content'],
            'is_edited' => true, // Mark as edited
        ]);

        return redirect()->route('tweets.index')->with('success', 'Tweet updated!');
    }

    // Delete tweet
    public function destroy(Tweet $tweet): RedirectResponse
    {
        if ($tweet->user_id !== Auth::id()) {
            abort(403);
        }

        $tweet->delete();

        return redirect()->route('tweets.index')->with('success', 'Tweet deleted!');
    }
}