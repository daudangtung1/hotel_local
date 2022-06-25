<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

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
}
