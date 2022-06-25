<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            User::create(['name' => 'admin' . $i, 'email' => 'guest' . $i . '@gmail.com', 'email_verified_at' => now(), 'password' => bcrypt('guest@#')]);
        }
    }
}
