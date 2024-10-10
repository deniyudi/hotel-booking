<?php

namespace App\Http\Controllers;

use App\Models\HotelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function my_bookings()
    {
        $user = Auth::user();
        $mybookings = HotelBooking::with(['room', 'hotel'])->where('user_id', $user->id)->latest()->get();
        return view('frontend.booking.my_bookings', compact('mybookings'));
    }

    public function booking_details(HotelBooking $hotelBooking)
    {
        return view('frontend.booking.booking_details', compact('hotelBooking'));
    }
}
