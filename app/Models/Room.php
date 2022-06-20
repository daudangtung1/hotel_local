<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    const READY = 0;
    const HAVE_GUEST = 1;
    const DIRTY = 2;
    const GUEST_OUTDOOR = 3;
    const CLEAN_ROOM = 4;
    const FIXING_ROOM = 5;
    const ARRAY_STATUS = [
        self::READY => "Sẵn sàng",
        self::HAVE_GUEST => "Có khách",
        self::GUEST_OUTDOOR => "Khách ra ngoài",
        self::DIRTY => "Bẩn",
        self::CLEAN_ROOM => "Đang dọn",
        self::FIXING_ROOM => "Đang sửa",
    ];

    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'floor',
        'type',
        'hour_price',
        'day_price'
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

    public function getStatusText()
    {
        switch ($this->status) {
            case self::READY:
                return 'Phòng trống';
            case self::DIRTY:
                return 'Phòng bẩn';
            default:
                return 'Đang có khách';
        }
    }

    public function getBgButton()
    {
        switch ($this->status) {
            case self::READY:
                return 'primary';
            case self::DIRTY:
                return 'danger';
            default:
                return 'warning';
        }
    }

    public function getTextButton()
    {
        switch ($this->status) {
            case self::READY:
                return 'Đặt phòng';
            case self::HAVE_GUEST:
                return 'Trả phòng';
            default:
                return 'Dọn xong';
        }
    }
}
