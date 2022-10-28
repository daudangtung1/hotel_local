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
        0 => 'Chưa thanh toán',
        1 => 'Đã thanh toán',
    ];

    public function bookingRoom()
    {
        return $this->belongsTo(BookingRoom::class);
    }
}
