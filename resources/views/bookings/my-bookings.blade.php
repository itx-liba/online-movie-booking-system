@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="card">
    <h2>My Bookings</h2>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if ($bookings->count() > 0)
        <table width="100%" cellpadding="10">
            <tr>
                <th>Movie</th>
                <th>Theater</th>
                <th>Date</th>
                <th>Time</th>
                <th>Class</th>
                <th>Adult</th>
                <th>Kids</th>
                <th>Total</th>
                <th>Status</th>
            </tr>

            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->movieShow->movie->title }}</td>
                    <td>{{ $booking->movieShow->theater->name }}</td>
                    <td>{{ $booking->movieShow->show_date }}</td>
                    <td>{{ $booking->movieShow->show_time }}</td>
                    <td>{{ ucfirst($booking->seat_class) }}</td>
                    <td>{{ $booking->adult_tickets }}</td>
                    <td>{{ $booking->kids_tickets }}</td>
                    <td>{{ $booking->total_amount }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>You have no bookings yet.</p>
    @endif
</div>
@endsection