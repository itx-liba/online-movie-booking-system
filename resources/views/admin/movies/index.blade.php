@extends('layouts.app')

@section('title', 'Manage Movies')

@section('content')
<div class="card">
    <h2>Manage Movies</h2>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="/admin/movies/create" class="btn">Add Movie</a>

    <br><br>

    @if ($movies->count() > 0)
        <table width="100%" cellpadding="10">
            <tr>
                <th>Title</th>
                <th>Theater</th>
                <th>Genre</th>
                <th>Duration</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>

            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->theater->name }}</td>
                    <td>{{ $movie->genre }}</td>
                    <td>{{ $movie->duration }} min</td>
                    <td>{{ $movie->rating }}/5</td>
                    <td>
                        <a href="/admin/movies/{{ $movie->id }}/edit" class="btn btn-secondary">Edit</a>

                        <form method="POST" action="/admin/movies/{{ $movie->id }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this movie?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No movies added yet.</p>
    @endif
</div>
@endsection