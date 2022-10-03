<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name'
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            create_log('Tạo mới loại');
        });

        static::updated(function ($item) {
            create_log('Cập nhật loại phòng');
        });

        static::deleted(function ($item) {
            create_log('Xóa loại phòng');
        });
    }
}
