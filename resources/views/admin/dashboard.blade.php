@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="card">
    <h2>Admin Dashboard</h2>
    <p>Welcome Admin, {{ Auth::user()->name }}</p>

    <div class="stats-grid">
        <div class="stat-box">
            <h3>{{ $totalUsers }}</h3>
            <p>Registered Users</p>
        </div>

        <div class="stat-box">
            <h3>{{ $totalTheaters }}</h3>
            <p>Theaters</p>
        </div>

        <div class="stat-box">
            <h3>{{ $totalMovies }}</h3>
            <p>Movies</p>
        </div>

        <div class="stat-box">
            <h3>{{ $totalShows }}</h3>
            <p>Shows</p>
        </div>

        <div class="stat-box">
            <h3>{{ $totalBookings }}</h3>
            <p>Bookings</p>
        </div>
    </div>

    <ul class="admin-list">
        <li><a href="/admin/theaters">Manage Theaters</a></li>
        <li><a href="/admin/movies">Manage Movies</a></li>
        <li><a href="/admin/shows">Manage Shows</a></li>
        <li><a href="/admin/users">View Registered Users</a></li>
        <li><a href="/admin/bookings">View All Bookings</a></li>
    </ul>
</div>
@endsection