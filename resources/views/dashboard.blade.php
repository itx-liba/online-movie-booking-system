@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="card">
    <h2>Welcome, {{ Auth::user()->name }}</h2>
    <p>This is your movie booking dashboard.</p>

    <a href="/movies" class="btn">Browse Movies</a>
</div>
@endsection