<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingRoom extends Model
{
    use HasFactory;

    protected $table = 'booking_rooms';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getTimeStartDate()
    {
        if ($this->start_date) {
            return $this->start_date->format('H:i');
        }
    }

    public function getDateStartDate()
    {
        if ($this->start_date) {
            return $this->start_date->format('d/m/Y');
        }
    }

    public function bookingRoom($data)
    {
        return DB::table($this->table)->insert($data);
    }
    
}
