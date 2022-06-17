<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoomService extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_room_id',
        'service_id',
        'quantity',
        'price',
        'created_at',
        'updated_at'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
