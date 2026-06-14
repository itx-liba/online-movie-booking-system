@extends('layouts.app')

@section('title', 'Edit Theater')

@section('content')
<div class="card form-box">
    <h2>Edit Theater</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/admin/theaters/{{ $theater->id }}">
        @csrf
        @method('PUT')

        <label>Theater Name</label>
        <input type="text" name="name" value="{{ old('name', $theater->name) }}">

        <label>City</label>
        <input type="text" name="city" value="{{ old('city', $theater->city) }}">

        <label>Location</label>
        <input type="text" name="location" value="{{ old('location', $theater->location) }}">

        <button type="submit">Update Theater</button>
    </form>
</div>
@endsection