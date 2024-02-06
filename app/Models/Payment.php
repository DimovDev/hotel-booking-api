<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'amount', 'payment_date', 'status'];

    /**
     * Get the booking associated with the payment..
     *
     * $return BelongsTo
     */
    public function booking(): BelongsTo
   {
       return $this->belongsTo(Booking::class);
   }
}
