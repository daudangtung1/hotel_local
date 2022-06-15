<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($j = 0; $j <= 20; $j++) {
            DB::table('services')->insert([
                'name'  => 'Dich vu ' . rand(1, 10),
                'stock' => rand(10, 50),
                'price' => rand(10, 20) . '000',
                'type'  => rand(0, 1),
            ]);
        }
    }
}
