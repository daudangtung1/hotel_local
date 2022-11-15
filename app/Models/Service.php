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
        self::DO_AN        => 'Food',
        self::DO_UONG      => 'Drinks',
        self::DICH_VU_KHAC => 'Other services',
    ];

    protected $fillable = [
        'branch_id',
        'name',
        'stock',
        'price',
        'type',
        'sale_type',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            create_log('Tạo mới dịch vụ');
        });

        static::updated(function ($item) {
            create_log('Cập nhật dịch vụ');
        });

        static::deleted(function ($item) {
            create_log('Xóa dịch vụ');
        });
    }

    public function getSaleType()
    {
        if ($this->sale_type) {
            return 'Dịch vụ theo lần sử dụng';
        }
        return 'Dịch vụ theo ngày';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
