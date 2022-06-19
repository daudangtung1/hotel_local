<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoomCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
      'booking_room_id',
      'customer_id',
      'updated_at',
      'created_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }
}
