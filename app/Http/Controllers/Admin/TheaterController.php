<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theater;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    public function index()
    {
        // Display the latest theaters first so recently added cinemas are easier to manage.

        $theaters = Theater::latest()->get();

        return view('admin.theaters.index', compact('theaters'));
    }

    public function create()
    {
        return view('admin.theaters.create');
    }

    public function store(Request $request)
    {
        // Validate theater details before saving to avoid incomplete cinema records.

        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Theater::create($request->only('name', 'city', 'location'));

        return redirect('/admin/theaters')->with('success', 'Theater added successfully.');
    }

    public function edit(Theater $theater)
    {
        return view('admin.theaters.edit', compact('theater'));
    }

    public function update(Request $request, Theater $theater)
    {
        // Apply the same validation rules when editing an existing theater.

        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $theater->update($request->only('name', 'city', 'location'));

        return redirect('/admin/theaters')->with('success', 'Theater updated successfully.');
    }

    public function destroy(Theater $theater)
    {
        // Delete the selected theater from the admin panel.
        
        $theater->delete();

        return redirect('/admin/theaters')->with('success', 'Theater deleted successfully.');
    }
}