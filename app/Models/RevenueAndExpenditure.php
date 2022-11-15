<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevenueAndExpenditure extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS = [
        0 => 'Receivables',
        1 => 'Expense',
    ];

    protected $fillable = [
        'branch_id',
        'name',
        'money',
        'type',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            create_log('Tạo mới thu chi');
        });

        static::updated(function ($item) {
            create_log('Cập nhật thu chi');
        });

        static::deleted(function ($item) {
            create_log('Xóa thu chi');
        });
    }
}
