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
        0 => 'Khoản thu',
        1 => 'Khoản chi',
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
}
