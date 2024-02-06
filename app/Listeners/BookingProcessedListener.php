<?php

namespace App\Listeners;

use App\Events\BookingProcessedEvent;
use Illuminate\Support\Facades\Mail;

class BookingProcessedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingProcessedEvent $event): void
    {
        $booking = $event->booking;

        Mail::to('staff@example.com', $booking)->send();
    }
}
