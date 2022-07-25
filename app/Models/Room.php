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
    const ARRAY_STATUS = [
        self::READY => "Sẵn sàng",
        self::HAVE_GUEST => "Có khách",
        self::GUEST_OUTDOOR => "Khách ra ngoài",
        self::DIRTY => "Bẩn",
        self::CLEAN_ROOM => "Đang dọn",
        self::FIXING_ROOM => "Đang sửa",
        self::BOOKED => "Đã đặt",
        self::NOT_FOR_RENT => "Phòng không cho thuê",
    ];

    const ARRAY_UPDATE_STATUS = [
        self::GUEST_OUTDOOR => "Khách ra ngoài",
        self::FIXING_ROOM => "Đang sửa",
    ];

    const FILTER_BY_ROOM = 0;
    const FILTER_BY_RAE = 1;
    const FILTER_BY_STATUS_ROOM = 2;
    const FILTER_BY_STATUS_ROOM_EMPTY = 3;

    const Filter = [
        self::FILTER_BY_ROOM => "Phòng đã sử dụng",
        self::FILTER_BY_RAE => "Thu chi",
        self::FILTER_BY_STATUS_ROOM => "Tình trạng phòng",
        self::FILTER_BY_STATUS_ROOM_EMPTY => "Tình trạng phòng trống",
    ];

    const UPDATE_STATUS = [
        self::READY => "Sẵn sàng",
        self::FIXING_ROOM => "Phòng đang sửa",
        self::NOT_FOR_RENT => "Không cho thuê",
    ];

    const IN = 'in';
    const OUT = 'out';
    const IN_GUEST = 'inGuest';
    const ROOM_EMPTY = 'roomEmpty';
    const NOT_FOR_RENT_TEXT = 'notForRent';
    const ARRAY_ROOM = [
        self::IN => 'IN',
        self::OUT => 'OUT',
        self::IN_GUEST => 'Khách ở',
        self::ROOM_EMPTY => 'Phòng trống',
        self::NOT_FOR_RENT_TEXT => '',
    ];

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
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
            case self::NOT_FOR_RENT:
                return 'Phòng Không cho thuê';
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
            case self::NOT_FOR_RENT  :
                return 'dark'; 
            default:
                return 'secondary';
        }
    }

    public function getTextButton()
    {
        if ($this->status == 0) {
            return 'Đặt phòng';
        } else if ($this->status == 1) {
            return 'Trả phòng';
        } else if ($this->status == 2) {
            return 'Dọn xong';
        } else if (in_array($this->status, [3, 5])) {
            return 'Trả phòng';
        }  else if (in_array($this->status, [8])) {
            return 'Phòng không cho thuê';
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

    public static function getUniqueFloor() {
        return self::select('floor as name')->distinct()->orderBy('name', 'ASC')->get();
    }

    public static function boot() {
        parent::boot();
        static::created(function($item) {
            create_log('Tạo mới phòng');
        });

        static::updated(function($item) {
            create_log('Cập nhật phòng');
        });

        static::deleted(function($item) {
            create_log('Xóa phòng');
        });
    }
}
