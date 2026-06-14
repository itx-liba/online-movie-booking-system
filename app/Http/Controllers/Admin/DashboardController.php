<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Movie;
use App\Models\MovieShow;
use App\Models\Theater;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Collect dashboard totals so the admin can quickly monitor system activity.

        $totalUsers = User::where('role', 'user')->count();
        $totalTheaters = Theater::count();
        $totalMovies = Movie::count();
        $totalShows = MovieShow::count();
        $totalBookings = Booking::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTheaters',
            'totalMovies',
            'totalShows',
            'totalBookings'
        ));
    }

    public function users()
    {
        // Show only normal registered users, not admin accounts.

        $users = User::where('role', 'user')->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function bookings()
    {
        // Load related user, movie, and theater data to avoid repeated database queries in the view.
        
        $bookings = Booking::with(['user', 'movieShow.movie', 'movieShow.theater'])
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }
}