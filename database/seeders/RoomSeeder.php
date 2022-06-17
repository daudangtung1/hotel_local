<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 20; $i++) {
            $room = Room::create([
                'name' => 'Room ' . $i,
                'status' => rand(0, 2),
                'floor' => 'Tầng ' . rand(1, 5),
            ]);
//
//            for($j = 0; $j <= 20; $j++) {
//                DB::table('booking_rooms')->insert([
//                    'room_id' => $room->id,
//                    'start_date' => Carbon::now(),
//                    'end_date' => Carbon::now()->addHour(rand(1, 20)),
//                ]);
//            }
        }
        for ($j = 0; $j <= 5; $j++) {
            DB::table('services')->insert([
                'name'  => 'Dich vu ' . rand(1, 10),
                'stock' => rand(10, 50),
                'price' => rand(10, 20) . '000',
                'type'  => rand(0, 1),
            ]);
        }
    }
}
