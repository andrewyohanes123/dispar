<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    $title = $faker->sentence();
    return [
        'title' => $title,
        'slug' => str_slug(strtolower($title), '-'),
        'hero_img' => 'default.jpg',
        'content' => $faker->paragraph(250),
        'user_id' => 1
    ];
});
