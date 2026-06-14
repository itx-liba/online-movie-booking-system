@extends('layouts.app')

@section('title', 'Home')

@section('content')

{{-- Hero section (top banner area) --}}
<section class="home-hero">
    <div class="hero-content">
        <h1>Book Your Favorite Movies Online</h1>
        <p>Watch trailers, explore showtimes, choose your class, and book tickets from home.</p>
        <a href="/movies" class="btn">Explore Movies</a>
    </div>
</section>

{{-- Section for featured movies --}}
<section class="home-section">
    <h2>Featured Movies</h2>

    @if ($movies->count() > 0)
        <div class="movie-grid">
            @foreach ($movies as $movie)
                <div class="card movie-card">
                    @if ($movie->poster)
                        <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="movie-poster">
                    @endif

                    <h3>{{ $movie->title }}</h3>
                    <p>{{ $movie->genre }} | {{ $movie->duration }} min</p>
                    <p>{{ Str::limit($movie->description, 80) }}</p>
                    <a href="/movies/{{ $movie->id }}" class="btn">View Details</a>
                </div>
            @endforeach
        </div>
    @else
        <div class="card">
            <p>No movies available yet.</p>
        </div>
    @endif
</section>

{{-- footer section --}}
<footer class="footer">
    <div class="footer-grid">
        <div>
            <h3>MovieBooking</h3>
            <p>
                Book movie tickets online, explore show timings, watch trailers,
                and enjoy a smoother cinema experience.
            </p>
        </div>

        <div>
            <h3>Quick Links</h3>
            <p><a href="/">Home</a></p>
            <p><a href="/about">About Us</a></p>
            <p><a href="/contact">Contact Us</a></p>
            <p><a href="/faqs">FAQs</a></p>
        </div>

        <div>
            <h3>Contact</h3>
            <p>Email: support@moviebooking.com</p>
            <p>Phone: +92 300 1234567</p>
            <p>Location: Lahore, Pakistan</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} MovieBooking. All rights reserved.</p>
    </div>
</footer>
@endsection