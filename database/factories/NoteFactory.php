<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'content' => $faker->paragraph(20),
        'link' => 'https://www.youtube.com/embed/K4DyBUG242c',
        'user_id' => 1,
        'created_at' => now()
    ];
});
