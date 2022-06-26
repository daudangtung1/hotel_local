<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create(['name'=>'admin', 'email'=>'admin@gmail.com', 'email_verified_at'=> now(), 'password'=> bcrypt('admin@#')]);
       User::create(['name'=>'admin', 'email'=>'guest@gmail.com', 'email_verified_at'=> now(), 'password'=> bcrypt('guest@#')]);
       User::create(['name'=>'admin', 'email'=>'staff@gmail.com', 'email_verified_at'=> now(), 'password'=> bcrypt('staff@#')]);

         for($i = 0; $i <= 10; $i++) {
             $room = Room::create([
                 'name' => 'Phòng số ' . $i,
                 'status' => 0,
                 'floor' => 'Tầng ' . rand(1, 5),
                 'hour_price' => rand(10, 20) . '000',
                 'day_price' => rand(20, 30) . '0000',
             ]);

             for($j = 0; $j <= 20; $j++) {
                 DB::table('booking_rooms')->insert([
                     'room_id' => $room->id,
                     'start_date' => Carbon::now(),
                     'end_date' => Carbon::now()->addHour(rand(1, 20)),
                 ]);
             }
         }
         for ($j = 0; $j <= 5; $j++) {
             DB::table('services')->insert([
                 'name'  => 'Dịch vụ ' . rand(1, 10),
                 'stock' => rand(10, 50),
                 'price' => rand(10, 20) . '000',
                 'type'  => rand(0, 1),
             ]);
         }
    }
}
