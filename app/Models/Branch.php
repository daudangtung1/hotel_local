<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Branch extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'branchs';
    protected $fillable = [
        'branch_id',
        'name',
        'note'
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            create_log('Tạo mới chi nhánh');
        });

        static::updated(function ($item) {
            create_log('Cập nhật chi nhánh');
        });

        static::deleted(function ($item) {
            create_log('Xóa chi nhánh');
        });
    }
}
