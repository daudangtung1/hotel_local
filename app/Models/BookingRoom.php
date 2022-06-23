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
        'status',
        'note',
        'price',
        'rent_type',
        'checkout_date',
        'extra_price',
        'user_id'
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

    public function customer()
    {
        return $this->belongsTo(Customers::class);
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

    public function getTimeCheckoutDate()
    {
        if (!empty($this->checkout_date)) {
            return date('H:i', strtotime($this->checkout_date));
        }
    }

    public function getDateCheckoutDate()
    {
        if (!empty($this->checkout_date)) {
            return date('d/m/Y', strtotime($this->checkout_date));
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

    public function getDiffHours()
    {
        $now = Carbon::now();

        $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date);

        return floor($createdAt->floatDiffInHours($now) + 1);
    }

    public function getDiffDay()
    {
        $now = Carbon::now();

        $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date);

        return floor($createdAt->floatDiffInDays($now) + 1);
    }

    public function getTime($suffixes = false)
    {
        if ($this->rent_type) {
            $time = $this->getDiffDay();
        } else {
            $time = $this->getDiffHours();
        }

        if ($suffixes) {
            if ($this->rent_type) {
                $suffixes = ' ngày';
            } else {
                $suffixes = ' giờ';
            }

            return $time . ' ' . $suffixes;
        }
        return $time;
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

    public function getTotalPrice($addTotalService = true, $format = true)
    {
        $price = $this->price ?? 0;
        if ($price <= 0) {
            if ($this->rent_type) {
                $price = $this->room->day_price ?? 0;
            } else {
                $price = $this->room->hour_price ?? 0;
            }
        }

        if (!$addTotalService) {
            $price = ($this->getTime() * $price) + $this->getExtraPrice();
            if (!$format) {
                return $price;
            }
            return get_price($price, 'đ');
        }


        $price = ($this->getTime() * $price) + $this->getTotalServices() + $this->getExtraPrice();

        return get_price($price, 'đ');
    }

    public function getExtraPrice()
    {
        $checkoutDate = $this->checkout_date;
        $endDate = $this->end_date;

        if (empty($checkoutDate) || empty($endDate)) {
            return 0;
        }
        $checkoutDate = Carbon::createFromFormat('Y-m-d H:i:s', $checkoutDate);
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $endDate);

        $hours = 0;
        if ($checkoutDate > $endDate) {
            $hours = floor($endDate->floatDiffInHours($checkoutDate) + 1);
        }

        $price = 0;
        if ($this->extra_price > 0) {
            $price = $this->extra_price;
        }

        return $price * $hours;
    }
}
