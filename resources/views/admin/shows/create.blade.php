@extends('layouts.app')

@section('title', 'Add Show')

@section('content')
<div class="card form-box">
    <h2>Add Show</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/admin/shows">
        @csrf

        <label>Movie</label>
        <select name="movie_id">
            <option value="">Select Movie</option>
            @foreach ($movies as $movie)
                <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                    {{ $movie->title }}
                </option>
            @endforeach
        </select>

        <label>Theater</label>
        <select name="theater_id">
            <option value="">Select Theater</option>
            @foreach ($theaters as $theater)
                <option value="{{ $theater->id }}" {{ old('theater_id') == $theater->id ? 'selected' : '' }}>
                    {{ $theater->name }} - {{ $theater->city }}
                </option>
            @endforeach
        </select>

        <label>Show Date</label>
        <input type="date" name="show_date" value="{{ old('show_date') }}">

        <label>Show Time</label>
        <input type="time" name="show_time" value="{{ old('show_time') }}">

        <label>Gold Rate</label>
        <input type="number" step="0.01" name="gold_rate" value="{{ old('gold_rate') }}">

        <label>Platinum Rate</label>
        <input type="number" step="0.01" name="platinum_rate" value="{{ old('platinum_rate') }}">

        <label>Box Rate</label>
        <input type="number" step="0.01" name="box_rate" value="{{ old('box_rate') }}">

        <button type="submit">Save Show</button>
    </form>
</div>
@endsection