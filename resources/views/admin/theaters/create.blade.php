@extends('layouts.app')

@section('title', 'Add Theater')

@section('content')
<div class="card form-box">
    <h2>Add Theater</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/admin/theaters">
        @csrf

        <label>Theater Name</label>
        <input type="text" name="name" value="{{ old('name') }}">

        <label>City</label>
        <input type="text" name="city" value="{{ old('city') }}">

        <label>Location</label>
        <input type="text" name="location" value="{{ old('location') }}">

        <button type="submit">Save Theater</button>
    </form>
</div>
@endsection