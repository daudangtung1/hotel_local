<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'branch_id',
        'from_user_id',
        'to_user_id',
        'hold_money',
        'send_money',
        'balance_number',
        'description',
        'created_at',
        'updated_at',
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            create_log('Tạo mới giao ca');
        });

        static::updated(function ($item) {
            create_log('Cập nhật giao ca');
        });

        static::deleted(function ($item) {
            create_log('Xóa giao ca');
        });
    }
}
