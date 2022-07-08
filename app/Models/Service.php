<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    const DO_AN = 0;
    const DO_UONG = 1;
    const DICH_VU_KHAC = 2;
    const ARRAY_SERVICE_TYPE = [
        self::DO_AN        => 'Đồ ăn',
        self::DO_UONG      => 'Đồ uống',
        self::DICH_VU_KHAC => 'Dịch vụ khác',
    ];

    protected $fillable = [
        'name',
        'stock',
        'price',
        'type',
        'user_id'
    ];

    public static function boot() {
        parent::boot();
        static::created(function($item) {
            create_log('Tạo mới dịch vụ');
        });

        static::updated(function($item) {
            create_log('Cập nhật dịch vụ');
        });

        static::deleted(function($item) {
            create_log('Xóa dịch vụ');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
