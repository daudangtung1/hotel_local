<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    const READY = 0;
    const HAVE_GUEST = 1;
    const DIRTY = 2;

    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'floor',
        'type',
        'price'
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
            case self::HAVE_GUEST:
                return 'Phòng trống';
            case self::DIRTY:
                return 'Có khách';
            default:
                return 'Phòng bẩn';
        }
    }

    public function getTextButton()
    {
        switch ($this->status) {
            case self::HAVE_GUEST:
                return 'Trả phòng';
            case self::DIRTY:
                return 'Dọn xong';
            default:
                return 'Đặt phòng';
        }
    }
}
