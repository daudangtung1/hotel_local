<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    const READY = 0;
    const HAVE_GUEST = 1;
    const DIRTY = 2;
    const GUEST_OUTDOOR = 3;
    const CLEAN_ROOM = 4;
    const FIXING_ROOM = 5;
    const BOOKED = 6;
    const ARRAY_STATUS = [
        self::READY => "Sẵn sàng",
        self::HAVE_GUEST => "Có khách",
        self::GUEST_OUTDOOR => "Khách ra ngoài",
        self::DIRTY => "Bẩn",
        self::CLEAN_ROOM => "Đang dọn",
        self::FIXING_ROOM => "Đang sửa",
    ];

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'floor',
        'type',
        'hour_price',
        'day_price',
        'user_id'
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
            case self::HAVE_GUEST:
                return 'Đang có khách';
            case self::GUEST_OUTDOOR:
                return 'Khách ra ngoài';
            case self::DIRTY:
                return 'Phòng bẩn';
            case self::CLEAN_ROOM:
                return 'Phòng đang dọn';
            default:
                return 'Phòng đang sửa';
        }
    }

    public function getBgButton()
    {
        switch ($this->status) {
            case self::READY:
                return 'primary';
            case self::HAVE_GUEST:
                return 'success';
            case self::GUEST_OUTDOOR:
                return 'info';
            case self::DIRTY:
                return 'danger';
            case self::CLEAN_ROOM:
                return 'warning';
            case self::BOOKED  :
                return 'light';
            default:
                return 'secondary';
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
