<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoomCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'booking_room_id',
        'customer_id',
        'type',
        'group_id',
        'updated_at',
        'created_at',
    ];

     public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function group()
    {
        return $this->belongsTo(Groups::class);
    }
}
