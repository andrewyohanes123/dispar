<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     UserSeeder::class,
        //     NewsSeeder::class,
        //     NoteSeeder::class,
        // ]);

        // for ($i = 1; $i <= 10; $i++)
        // {
        //     DB::table('sites')->insert([
        //         'name' => "Objek wisata {$i}",
        //         'slug' => str_slug(strtolower("Objek wisata {$i}")),
        //         'longitude' => 124 + (0.85 * $i),
        //         'latitude' => 1 + (0.5 * $i),
        //         'description' => "Ini adalah objek wisata {$i} di kota Manado.",
        //         'site_type_id' => 5,
        //         'address' => "Jl. jalan no {$i}",
        //         'travel_type_id' => rand(1, 3)
        //     ]);
            DB::table('site_pictures')->insert([
                // ['photo' => '1.jpg', 'site_id' => $i],
                // ['photo' => '2.jpg', 'site_id' => $i],
                ['photo' => '3.jpg', 'site_id' => 11]
            ]);
        // }

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
