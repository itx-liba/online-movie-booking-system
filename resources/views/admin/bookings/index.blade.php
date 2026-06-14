@extends('layouts.app')

@section('title', 'All Bookings')

@section('content')
<div class="card">
    <h2>All Bookings</h2>

    @if ($bookings->count() > 0)
        <table width="100%" cellpadding="10">
            <tr>
                <th>User</th>
                <th>Movie</th>
                <th>Theater</th>
                <th>Date</th>
                <th>Time</th>
                <th>Class</th>
                <th>Tickets</th>
                <th>Total</th>
                <th>Status</th>
            </tr>

            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->movieShow->movie->title }}</td>
                    <td>{{ $booking->movieShow->theater->name }}</td>
                    <td>{{ $booking->movieShow->show_date }}</td>
                    <td>{{ $booking->movieShow->show_time }}</td>
                    <td>{{ ucfirst($booking->seat_class) }}</td>
                    <td>
                        Adult: {{ $booking->adult_tickets }},
                        Kids: {{ $booking->kids_tickets }}
                    </td>
                    <td>{{ $booking->total_amount }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No bookings found.</p>
    @endif
</div>
@endsection