<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Theater;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        // Load movies with their theater data to display complete movie information in the admin table.

        $movies = Movie::with('theater')->latest()->get();

        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        // Theaters are required so the admin can assign each movie to a cinema

        $theaters = Theater::orderBy('name')->get();

        return view('admin.movies.create', compact('theaters'));
    }

    public function store(Request $request)
    {
        // Validate movie details before saving to keep the movie records complete and reliable.

        $request->validate([
            'theater_id' => 'required|exists:theaters,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'release_date' => 'required|date',
            'poster' => 'nullable|string|max:255',
            'trailer_url' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Movie::create($request->only([
            'theater_id',
            'title',
            'description',
            'genre',
            'duration',
            'release_date',
            'poster',
            'trailer_url',
            'rating',
        ]));

        return redirect('/admin/movies')->with('success', 'Movie added successfully.');
    }

    public function edit(Movie $movie)
    {
        // Load theaters again so the admin can change the movie's assigned theater if needed.

        $theaters = Theater::orderBy('name')->get();

        return view('admin.movies.edit', compact('movie', 'theaters'));
    }

    public function update(Request $request, Movie $movie)
    {
        // Use the same validation rules during update to keep edited movie data consistent.

        $request->validate([
            'theater_id' => 'required|exists:theaters,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'release_date' => 'required|date',
            'poster' => 'nullable|string|max:255',
            'trailer_url' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $movie->update($request->only([
            'theater_id',
            'title',
            'description',
            'genre',
            'duration',
            'release_date',
            'poster',
            'trailer_url',
            'rating',
        ]));

        return redirect('/admin/movies')->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        // Deleting a movie also removes related dependent records if database cascade rules are enabled
        
        $movie->delete();

        return redirect('/admin/movies')->with('success', 'Movie deleted successfully.');
    }
}