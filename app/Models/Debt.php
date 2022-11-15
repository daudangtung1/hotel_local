<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    CONST NOT_PAY = 0;
    CONST PAYED = 1;
    CONST ARRAY_STATUS = [
        0 => 'Unpaid',
        1 => 'Paid',
    ];
    
    protected $fillable = [
        'name',
        'booking_room_id',
        'price',
        'status',
        'branch_id' 
    ];

    public function bookingRoom()
    {
        return $this->belongsTo(BookingRoom::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}
