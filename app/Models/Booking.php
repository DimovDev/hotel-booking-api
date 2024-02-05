<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'customer_id', 'check_in_date', 'check_out_date', 'total_price'];

    /**
     * Get the room associated with the booking..
     *
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the customer associated with the booking..
     *
     * $return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Calculate the booking price based on the provided attributes.
     *
     * @param array $attributes The attributes for the booking including room_id, check_in_date, and check_out_date
     * @return array The newly created booking object
     */
    public static function calculateBookingPrice(array $attributes):array
    {
        $room = Room::findOrFail($attributes['room_id']);
        $pricePerNight =  $room->price_per_night;
        $checkInDate = Carbon::parse($attributes['check_in_date']);
        $checkOutDate = Carbon::parse($attributes['check_out_date']);

        $attributes['total_price'] = $pricePerNight * $checkInDate->diffInDays($checkOutDate);

        return $attributes;
    }
}
