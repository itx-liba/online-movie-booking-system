<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\MovieShow;
use App\Models\Theater;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index()
    {
        // Load movie and theater relationships so each show row displays complete schedule details.

        $shows = MovieShow::with(['movie', 'theater'])->latest()->get();

        return view('admin.shows.index', compact('shows'));
    }

    public function create()
    {
        // Movies and theaters are needed to connect each show to the correct screening location.

        $movies = Movie::orderBy('title')->get();
        $theaters = Theater::orderBy('name')->get();

        return view('admin.shows.create', compact('movies', 'theaters'));
    }

    public function store(Request $request)
    {
        // Validate show schedule and class rates before saving.

        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theater_id' => 'required|exists:theaters,id',
            'show_date' => 'required|date',
            'show_time' => 'required',
            'gold_rate' => 'required|numeric|min:0',
            'platinum_rate' => 'required|numeric|min:0',
            'box_rate' => 'required|numeric|min:0',
        ]);

        MovieShow::create($request->only([
            'movie_id',
            'theater_id',
            'show_date',
            'show_time',
            'gold_rate',
            'platinum_rate',
            'box_rate',
        ]));

        return redirect('/admin/shows')->with('success', 'Show added successfully.');
    }

    public function edit(MovieShow $movieShow)
    {
        // Load available movies and theaters so the admin can update the show assignment.

        $movies = Movie::orderBy('title')->get();
        $theaters = Theater::orderBy('name')->get();

        return view('admin.shows.edit', compact('movieShow', 'movies', 'theaters'));
    }

    public function update(Request $request, MovieShow $movieShow)
    {
        // Reuse validation during updates to prevent incomplete or invalid show data.

        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theater_id' => 'required|exists:theaters,id',
            'show_date' => 'required|date',
            'show_time' => 'required',
            'gold_rate' => 'required|numeric|min:0',
            'platinum_rate' => 'required|numeric|min:0',
            'box_rate' => 'required|numeric|min:0',
        ]);

        $movieShow->update($request->only([
            'movie_id',
            'theater_id',
            'show_date',
            'show_time',
            'gold_rate',
            'platinum_rate',
            'box_rate',
        ]));

        return redirect('/admin/shows')->with('success', 'Show updated successfully.');
    }

    public function destroy(MovieShow $movieShow)
    {
        // Remove the selected show from the schedule.
        
        $movieShow->delete();

        return redirect('/admin/shows')->with('success', 'Show deleted successfully.');
    }
}