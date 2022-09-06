<?php

namespace App\Models;

use Carbon\Carbon;
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
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function bookingRoom()
    {
        return $this->belongsTo(BookingRoom::class);
    }

    public function getTotalDate($showDate = false)
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $total = $endDate->diffInDays($startDate);
        if($showDate) {
            return $total . ' ngày';    
        }
        return $total;
    }
}
