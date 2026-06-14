@extends('layouts.app')

@section('title', 'Book Ticket')

@section('content')
<div class="card form-box">
    <h2>Book Ticket</h2>

    <p><strong>Movie:</strong> {{ $movieShow->movie->title }}</p>
    <p><strong>Theater:</strong> {{ $movieShow->theater->name }}</p>
    <p><strong>Date:</strong> {{ $movieShow->show_date }}</p>
    <p><strong>Time:</strong> {{ $movieShow->show_time }}</p>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/bookings/{{ $movieShow->id }}">
        @csrf

        <label>Seat Class</label>
        <select name="seat_class">
            <option value="">Select Class</option>
            <option value="gold" {{ old('seat_class') == 'gold' ? 'selected' : '' }}>
                Gold - {{ $movieShow->gold_rate }}
            </option>
            <option value="platinum" {{ old('seat_class') == 'platinum' ? 'selected' : '' }}>
                Platinum - {{ $movieShow->platinum_rate }}
            </option>
            <option value="box" {{ old('seat_class') == 'box' ? 'selected' : '' }}>
                Box - {{ $movieShow->box_rate }}
            </option>
        </select>

        <label>Adult Tickets</label>
        <input type="number" min="0" name="adult_tickets" value="{{ old('adult_tickets', 1) }}">

        <label>Kids Tickets</label>
        <input type="number" min="0" name="kids_tickets" value="{{ old('kids_tickets', 0) }}">

        <p>Kids tickets get 50% concession.</p>

        <button type="submit">Confirm Booking</button>
    </form>
</div>
@endsection