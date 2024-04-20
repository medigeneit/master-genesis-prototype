<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::all();

        return view('booking.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        return view('booking.create');
    }

    public function store(BookingStoreRequest $request)
    {
        $booking = Booking::create($request->validated());

        $request->session()->flash('booking.id', $booking->id);

        return redirect()->route('bookings.index');
    }

    public function show(Request $request, Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    public function edit(Request $request, Booking $booking)
    {
        return view('booking.edit', compact('booking'));
    }

    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        $request->session()->flash('booking.id', $booking->id);

        return redirect()->route('bookings.index');
    }

    public function destroy(Request $request, Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index');
    }
}
