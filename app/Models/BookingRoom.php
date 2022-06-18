<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingRoom extends Model
{
    use HasFactory;

    protected $table = 'booking_rooms';

    const READY = 0;
    const BUSY = 1;
    const GUEST_OUT = 2;
    const DIRTY = 3;
    const CLEANING = 4;
    const FIXING = 5;
    const BOOKING_ROOM = 6;

    protected $fillable = [
        'room_id',
        'customer_id',
        'start_date',
        'end_date',
        'id_card',
        'status'
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function bookingRoomCustomers()
    {
        return $this->hasMany(BookingRoomCustomer::class, 'booking_room_id', 'id');
    }

    public function bookingRoomServices()
    {
        return $this->hasMany(BookingRoomService::class, 'booking_room_id', 'id');
    }

    public function getTimeStartDate()
    {
        if ($this->start_date) {
            return $this->start_date->format('H:i');
        }
    }

    public function getDateStartDate()
    {
        if ($this->start_date) {
            return $this->start_date->format('d/m/Y');
        }
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

    public function getDiffMinutes()
    {
        $now = Carbon::now();

        $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date);

        return $createdAt->diffInMinutes($now);
    }

    public function getTotalMinutes()
    {
        return $this->getDiffMinutes();
    }

    public function getTotalServices()
    {
        $services = $this->bookingRoomServices()->get();
        $total = 0;
        if (!empty($services)) {
            foreach ($services as $service) {
                $total = $total + ($service->quantity * $service->price);
            }
        }
        return $total;
    }

    public function getTotalPrice()
    {
        $price = $this->getDiffMinutes() * $this->room->price + $this->getTotalServices();

        return get_price($price, 'vnđ');
    }
}
