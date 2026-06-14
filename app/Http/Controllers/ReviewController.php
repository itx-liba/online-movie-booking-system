<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        // Validate review input so each review has a rating and readable comment.
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $movie->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        // Update the movie rating using the average of all user reviews.

        $averageRating = Review::where('movie_id', $movie->id)->avg('rating');

        $movie->update([
            'rating' => round($averageRating, 1),
        ]);

        return back()->with('success', 'Review added successfully.');
    }
}