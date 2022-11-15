<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCustomer extends Model
{
    use HasFactory;

    protected $table = 'group_customers';
    protected $fillable = [
        'branch_id', 'customer_id', 'group_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            create_log('Tạo mới nhóm khách hàng');
        });

        static::updated(function ($item) {
            create_log('Cập nhật nhóm khách hàng');
        });

        static::deleted(function ($item) {
            create_log('Xóa nhóm khách hàng');
        });
    }
}
