<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    const READY = 0;
    const BUSY = 1;
    const GUEST_OUT = 2;
    const DIRTY = 3;
    const CLEANING = 4;
    const FIXING = 5;
    const BOOKING_ROOM = 6;

    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'floor'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    public function bookingRooms()
    {
        return $this->hasMany(BookingRoom::class);
    }

    public function getStatus()
    {
        switch ($this->status) {
            case self::BOOKING_ROOM:
                return 'Đặt phòng';
            case self::BUSY:
                return 'Có khách';
            case self::GUEST_OUT:
                return 'Khách ra ngoài';
            case self::DIRTY:
                return 'Bẩn';
            case self::CLEANING:
                return 'Đang dọn';
            case self::FIXING:
                return 'Đang sửa';
            default:
                return 'Phòng trống';
        }
    }

    public function getStatusBackgroundColor()
    {
        switch ($this->status) {
            case self::BOOKING_ROOM:
                return 'black';
            case self::BUSY:
                return 'green';
            case self::GUEST_OUT:
                return '#ccc';
            case self::DIRTY:
                return 'red';
            case self::CLEANING:
                return 'orange';
            case self::FIXING:
                return 'brown';
            default:
                return '#bfdbff';
        }
    }
}
