@extends('layouts.app')

@section('title', 'Movies')

@section('content')
<h2>Now Showing</h2>

@if ($movies->count() > 0)
    <div class="movie-grid">
        @foreach ($movies as $movie)
            <div class="card movie-card">
                @if ($movie->poster)
    <img src="{{ asset($movie->poster) }}" alt="{{ $movie->title }}" class="movie-poster">
@endif

                <h3>{{ $movie->title }}</h3>
                <p>{{ $movie->genre }} | {{ $movie->duration }} min</p>
                <p>Rating: {{ $movie->rating }}/5</p>
                <p>Theater: {{ $movie->theater->name }}</p>

                <a href="/movies/{{ $movie->id }}" class="btn">View Details</a>
            </div>
        @endforeach
    </div>
@else
    <div class="card">
        <p>No movies available yet.</p>
    </div>
@endif
@endsection