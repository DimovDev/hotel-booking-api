<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_number'];

    /**
     * Get bookings associated with the customer.
     *
     * @return HasMany
     */
    public function bookings():HasMany
    {
        return $this->hasMany(Booking::class);
    }

}
