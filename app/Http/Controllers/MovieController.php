<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieShow;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        // Show all movies with their theater information on the public movies page.

        $movies = Movie::with('theater')->latest()->get();

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
{
    // Load reviews and theater details for the selected movie detail page.

    $movie->load(['reviews.user', 'theater']);

    // Show only the schedules that belong to this specific movie.

    $shows = MovieShow::with('theater')
        ->where('movie_id', $movie->id)
        ->orderBy('show_date')
        ->orderBy('show_time')
        ->get();

    return view('movies.show', compact('movie', 'shows'));
}
    public function home()
{
    // Display a limited set of recent movies on the home page.
    
    $movies = Movie::with('theater')->latest()->take(8)->get();

    return view('home', compact('movies'));
}
}