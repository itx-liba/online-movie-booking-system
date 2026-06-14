@extends('layouts.app')

@section('title', 'Edit Movie')

@section('content')
<div class="card form-box">
    <h2>Edit Movie</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/admin/movies/{{ $movie->id }}">
        @csrf
        @method('PUT')

        <label>Theater</label>
        <select name="theater_id">
            <option value="">Select Theater</option>
            @foreach ($theaters as $theater)
                <option value="{{ $theater->id }}" {{ old('theater_id', $movie->theater_id) == $theater->id ? 'selected' : '' }}>
                    {{ $theater->name }} - {{ $theater->city }}
                </option>
            @endforeach
        </select>

        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', $movie->title) }}">

        <label>Description</label>
        <textarea name="description">{{ old('description', $movie->description) }}</textarea>

        <label>Genre</label>
        <input type="text" name="genre" value="{{ old('genre', $movie->genre) }}">

        <label>Duration in Minutes</label>
        <input type="number" name="duration" value="{{ old('duration', $movie->duration) }}">

        <label>Release Date</label>
        <input type="date" name="release_date" value="{{ old('release_date', $movie->release_date) }}">

        <label>Poster URL</label>
        <input type="text" name="poster" value="{{ old('poster', $movie->poster) }}">

        <label>Trailer URL</label>
        <input type="text" name="trailer_url" value="{{ old('trailer_url', $movie->trailer_url) }}">

        <label>Rating</label>
        <input type="number" step="0.1" min="0" max="5" name="rating" value="{{ old('rating', $movie->rating) }}">

        <button type="submit">Update Movie</button>
    </form>
</div>
@endsection