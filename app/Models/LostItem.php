<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'user_id',
        'note',
        'booking_room_id',
        'pay_date',
        'updated_at',
        'created_at',
    ];

    public function bookingRoom()
    {
        return $this->belongsTo(BookingRoom::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            create_log('Tạo mới đồ thất lạc');
        });

        static::updated(function ($item) {
            create_log('Cập nhật đồ thất lạc');
        });

        static::deleted(function ($item) {
            create_log('Xóa đồ thất lạc');
        });
    }
}
