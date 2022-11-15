<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Event;

class Room extends Model
{
    const READY = 0;
    const HAVE_GUEST = 1;
    const DIRTY = 2;
    const GUEST_OUTDOOR = 3;
    const CLEAN_ROOM = 4;
    const FIXING_ROOM = 5;
    const BOOKED = 6;
    const CLOSED = 7;
    const NOT_FOR_RENT = 8;
    const FILTER_FREQUENCY = 9;
    const SERVICE = 10;
    const ARRAY_STATUS = [
        self::READY => 'Ready',
        self::HAVE_GUEST => 'Have_guest',
        self::GUEST_OUTDOOR => 'Guest_out',
        self::DIRTY => 'Dirty',
        self::CLEAN_ROOM => 'Cleaning',
        self::FIXING_ROOM => 'Fixing',
        self::BOOKED => 'Booking_room',
        self::NOT_FOR_RENT => "Room_not_for_rent",
    ];

    const ARRAY_UPDATE_STATUS = [
        self::HAVE_GUEST =>'Have_guest',
        self::GUEST_OUTDOOR => 'Guest_out',
    ];

    const FILTER_BY_ROOM = 0;
    const FILTER_BY_RAE = 1;
    const FILTER_BY_STATUS_ROOM = 2;
    const FILTER_BY_STATUS_ROOM_EMPTY = 3;

    const Filter = [
        self::FILTER_BY_ROOM => "Room used",
        self::FILTER_BY_RAE => "Revenue",
        self::FILTER_BY_STATUS_ROOM => "Room status",
        self::FILTER_BY_STATUS_ROOM_EMPTY => "Room empty status",
        self::FILTER_FREQUENCY => "Room frequency",
        self::SERVICE => "Service",
    ];

    const UPDATE_STATUS = [
        self::READY => 'Ready',
        self::FIXING_ROOM => 'Fixing',
        self::NOT_FOR_RENT => "Room_not_for_rent",
    ];

    const IN = 'in';
    const OUT = 'out';
    const IN_GUEST = 'inGuest';
    const ROOM_EMPTY = 'roomEmpty';
    const NOT_FOR_RENT_TEXT = 'notForRent';
    const ARRAY_ROOM = [
        self::IN => 'IN',
        self::OUT => 'OUT',
        self::IN_GUEST => 'Have_guest',
        self::ROOM_EMPTY => 'Ready',
        self::NOT_FOR_RENT_TEXT => 'Room_not_for_rent',
    ];

    public function getStatusText()
    {
        switch ($this->status) {
            case self::READY:
                return 'Ready';
            case self::HAVE_GUEST:
                return 'Have_guest';
            case self::GUEST_OUTDOOR:
                return 'Guest_out';
            case self::DIRTY:
                return 'Dirty';
            case self::CLEAN_ROOM:
                return 'Cleaning';
            case self::NOT_FOR_RENT:
                return 'Room_not_for_rent';
            default:
                return 'Fixing';
        }
    }

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'branch_id',
        'name',
        'status',
        'floor',
        'type',
        'hour_price',
        'month_price',
        'day_price',
        'user_id',
        'type_room_id',
        'status_desc',
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

    public function typeRoom()
    {
        return $this->belongsTo(TypeRoom::class);
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
            case self::BOOKED:
                return 'light';
            case self::NOT_FOR_RENT:
                return 'dark';
            default:
                return 'secondary';
        }
    }

    public function getTextButton()
    {
        if ($this->status == 0) {
            return 'Booking_room';
        } else if ($this->status == 1) {
            return 'Checkout';
        } else if ($this->status == 2) {
            return 'Done cleaning';
        } else if (in_array($this->status, [3, 5])) {
            return 'Checkout';
        } else if (in_array($this->status, [8])) {
            return 'Room_not_for_rent';
        }
    }

    public function getBgButtonSubmit()
    {
        if ($this->status == 0) {
            return 'primary';
        } else if ($this->status == 1) {
            return 'success';
        } else if ($this->status == 2) {
            return 'danger';
        } else if (in_array($this->status, [3, 5])) {
            return 'success';
        } elseif ($this->status == 8) {
            return 'dark';
        }
    }

    public static function getUniqueFloor()
    {
        return self::select('floor as name')->distinct()->orderBy('name', 'ASC')->get();
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            create_log('Tạo mới phòng');
        });

        static::updated(function ($item) {
            create_log('Cập nhật phòng');
        });

        static::deleted(function ($item) {
            create_log('Xóa phòng');
        });
    }
}
