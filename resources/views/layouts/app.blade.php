<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Online Movie Booking')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="container navbar-content">
            <a href="/" class="logo">MovieBooking</a>

            <div class="nav-links">
    @if (request()->is('/') || request()->is('about') || request()->is('contact') || request()->is('faqs'))
        <a href="/">Home</a>
        <a href="/about">About Us</a>
        <a href="/contact">Contact Us</a>
        <a href="/faqs">FAQs</a>
        <a href="/login" class="user-icon" title="Login or Register">
    <span class="user-icon-circle">Account</span>
</a>
    @else
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="/admin/dashboard">Admin Dashboard</a>
            @else
                <a href="/dashboard">Dashboard</a>
                <a href="/movies">Movies</a>
                <a href="/my-bookings">My Bookings</a>
            @endif

            <form method="POST" action="/logout" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="/">Home</a>
            <a href="/login" class="user-icon" title="Login or Register">
    <span class="user-icon-circle">Account</span>
</a>
        @endauth
    @endif
</div>
        </div>
    </nav>

    <main class="page">
        <div class="container">
            @yield('content')
        </div>
    </main>

</body>
</html>