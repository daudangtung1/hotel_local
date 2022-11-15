<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'address',
        'phone',
        'email',
        'fax',
    ];

    public static function boot()
    {
        parent::boot();
        static::updated(function ($item) {
            create_log('Cập nhật thông tin cơ sở');
        });
    }
}
