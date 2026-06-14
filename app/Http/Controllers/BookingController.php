<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\MovieShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(MovieShow $movieShow)
    {
        // Load movie and theater details for the selected show before displaying the booking form.

        $movieShow->load(['movie', 'theater']);

        return view('bookings.create', compact('movieShow'));
    }

    public function store(Request $request, MovieShow $movieShow)
    {
        // Validate the selected class and ticket quantities before calculating the booking total.

        $request->validate([
            'seat_class' => 'required|in:gold,platinum,box',
            'adult_tickets' => 'required|integer|min:0',
            'kids_tickets' => 'required|integer|min:0',
        ]);

        $adultTickets = $request->adult_tickets;
        $kidsTickets = $request->kids_tickets;

        // A booking must contain at least one adult or kids ticket.

        if ($adultTickets + $kidsTickets < 1) {
            return back()->withErrors(['tickets' => 'Please select at least one ticket.']);
        }

        $rate = 0;

        // Select the ticket rate based on the user's chosen seat class.

        if ($request->seat_class === 'gold') {
            $rate = $movieShow->gold_rate;
        } elseif ($request->seat_class === 'platinum') {
            $rate = $movieShow->platinum_rate;
        } elseif ($request->seat_class === 'box') {
            $rate = $movieShow->box_rate;
        }
        
        // Kids tickets receive a 50% concession.
        
        $adultTotal = $adultTickets * $rate;
        $kidsTotal = $kidsTickets * ($rate * 0.5);
        $totalAmount = $adultTotal + $kidsTotal;

        Booking::create([
            'user_id' => Auth::id(),
            'movie_show_id' => $movieShow->id,
            'seat_class' => $request->seat_class,
            'adult_tickets' => $adultTickets,
            'kids_tickets' => $kidsTickets,
            'total_amount' => $totalAmount,
            'status' => 'confirmed',
        ]);

        return redirect('/my-bookings')->with('success', 'Ticket booked successfully.');
    }

    public function myBookings()
    {
        // Show only the bookings made by the currently logged-in user.
        
        $bookings = Booking::with(['movieShow.movie', 'movieShow.theater'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('bookings.my-bookings', compact('bookings'));
    }
}