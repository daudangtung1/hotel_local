<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'user_id',
        'note',
        'booking_room_id',
        'pay_date',
        'updated_at',
        'created_at',
    ];

    public function bookingRoom()
    {
        return $this->belongsTo(BookingRoom::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }
}
