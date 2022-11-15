<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use File;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viItems = File::get(resource_path('lang/vi_init.json'));
        $enItems = File::get(resource_path('lang/en_init.json'));
        $viItems = json_decode($viItems,true);
        $enItems = json_decode($enItems,true);
        $data = [];

        foreach($viItems as $key => $viItem) {
            $data[$key]['vi'] = $viItem;
        }

        foreach($enItems as $key => $enItem) {
            $data[$key]['en'] = $enItem;
        }

        foreach($data as $key => $value) {
            Language::create(['key' => $key, 'en' => $value['en'], 'vi' => $value['vi']]);
        }
    }
}
