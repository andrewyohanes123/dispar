<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('site_types')->insert([
        //     ['name' => 'Hotel'],
        //     ['name' => 'Restoran'],
        //     ['name' => 'Market'],
        //     ['name' => 'Travel Guide'],
        //     ['name' => 'Objek Wisata'],
        // ]);
        
        // DB::table('travel_types')->insert([
        //     ['name' => 'Wisata Alam', 'site_type_id' => 5],
        //     ['name' => 'Wisata Kuliner', 'site_type_id' => 5],
        //     ['name' => 'Wisata Religi', 'site_type_id' => 5],
        // ]);
    }
}
