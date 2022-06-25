<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Customers extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'customers';
    protected $fillable = ['name', 'id_card', 'phone', 'address', 'created_at', 'updated_at'];

    public static function boot() {
        parent::boot();
        static::created(function($item) {
            create_log('Tạo mới khách hàng');
        });

        static::updated(function($item) {
            create_log('Cập nhật khách hàng');
        });

        static::deleted(function($item) {
            create_log('Xóa khách hàng');
        });
    }
}
