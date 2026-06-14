@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="card">
    <h2>{{ $movie->title }}</h2>

    @if ($movie->poster)
    <img src="{{ asset($movie->poster) }}" alt="{{ $movie->title }}" class="movie-detail-poster">
@endif

    <p><strong>Genre:</strong> {{ $movie->genre }}</p>
    <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
    <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
    <p><strong>Rating:</strong> {{ $movie->rating }}/5</p>
    <p><strong>Theater:</strong> {{ $movie->theater->name }} - {{ $movie->theater->city }}</p>

    <p>{{ $movie->description }}</p>

    @if ($movie->trailer_url)
        <p>
            <a href="{{ $movie->trailer_url }}" target="_blank" class="btn btn-secondary">Watch Trailer</a>
        </p>
    @endif
</div>

<div class="card">
    <h3>Available Shows</h3>

    @if ($shows->count() > 0)
        <table width="100%" cellpadding="10">
            <tr>
                <th>Theater</th>
                <th>Date</th>
                <th>Time</th>
                <th>Gold</th>
                <th>Platinum</th>
                <th>Box</th>
                <th>Action</th>
            </tr>

            @foreach ($shows as $show)
                <tr>
                    <td>{{ $show->theater->name }}</td>
                    <td>{{ $show->show_date }}</td>
                    <td>{{ $show->show_time }}</td>
                    <td>{{ $show->gold_rate }}</td>
                    <td>{{ $show->platinum_rate }}</td>
                    <td>{{ $show->box_rate }}</td>
                    <td>
                        <a href="/bookings/create/{{ $show->id }}" class="btn">Book Ticket</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No shows available for this movie yet.</p>
    @endif
</div>

<div class="card">
    <h3>Reviews</h3>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @auth
        @if(Auth::user()->role !== 'admin')
            <form method="POST" action="/movies/{{ $movie->id }}/reviews">
                @csrf

                <label>Rating</label>
                <select name="rating">
                    <option value="">Select Rating</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Bad</option>
                </select>

                <label>Comment</label>
                <textarea name="comment">{{ old('comment') }}</textarea>

                <button type="submit">Submit Review</button>
            </form>
        @endif
    @else
        <p><a href="/login">Login</a> to write a review.</p>
    @endauth

    <br>

    @if ($movie->reviews->count() > 0)
        @foreach ($movie->reviews as $review)
            <div class="review-box">
                <strong>{{ $review->user->name }}</strong>
                <p>Rating: {{ $review->rating }}/5</p>
                <p>{{ $review->comment }}</p>
            </div>
        @endforeach
    @else
        <p>No reviews yet.</p>
    @endif
</div>
@endsection