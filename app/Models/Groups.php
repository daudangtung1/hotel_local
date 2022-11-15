<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'groups';
    protected $fillable = [
        'branch_id', 'name', 'note'
    ];

    public function customers()
    {
        return $this->belongsToMany(Customers::class, 'group_customers', 'group_id', 'customer_id');
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            create_log('Tạo mới khách đoàn');
        });

        static::updated(function ($item) {
            create_log('Cập nhật khách đoàn');
        });

        static::deleted(function ($item) {
            create_log('Xóa khách đoàn');
        });
    }
}
