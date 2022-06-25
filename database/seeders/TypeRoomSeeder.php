<?php

namespace Database\Seeders;

use App\Models\TypeRoom;
use App\Models\User;
use Illuminate\Database\Seeder;

class TypeRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            TypeRoom::create(['name' => 'admin' . $i]);
        }
    }
}
