<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoomService extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
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

    public function getPrice()
    {
        if (!empty($this->start_date) && !empty($this->end_date)) {
            return $this->getTotalDate(false) * $this->price;
        }
        return $this->price * $this->quantity;
    }
    public function getQuantity()
    {
        if (!empty($this->start_date) && !empty($this->end_date)) {
            return $this->getTotalDate(false);
        }
        return $this->quantity ?? 0;
    }

    public function bookingRoom()
    {
        return $this->belongsTo(BookingRoom::class);
    }

    public function getTotalDate($showDate = false)
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $diffInHours = $endDate->diffInHours($startDate);
        $total = round(($diffInHours / 24), 1, PHP_ROUND_HALF_UP);
        if ($showDate) {
            return $total . ' ' . __('day');
        }
        return $total;
    }
}
