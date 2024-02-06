<?php

namespace App\Http\Controllers\Api;

use App\Events\BookingProcessedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $bookings = Booking::with(['room', 'customer'])->get();
        return BookingResource::collection($bookings);
    }


    /**
     * Store a newly created resource in storage.
     * @param StoreBookingRequest $request
     * @return BookingResource
     */
    public function store(StoreBookingRequest $request): BookingResource
    {
        $attributes = Booking::calculateBookingPrice($request->all());
        $booking = Booking::create($attributes);

        event(new BookingProcessedEvent($booking));

        return new BookingResource($booking);
    }

    /**
     * Display the specified resource.
     * @param Booking $booking
     * @return BookingResource
     */
    public function show(Booking $booking): BookingResource
    {
        $booking->load(['room', 'customer']);
        return new BookingResource($booking);
    }


}
