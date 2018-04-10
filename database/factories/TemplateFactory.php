<?php

use Faker\Generator as Faker;
use App\Models\Template;

$factory->define(Template::class, function (Faker $faker) {
    
    $name = $faker->sentence(5);

    return [
        'type' => $faker->randomElement(['ad', 'page']),
        'name' => $name,
        'slug' => str_slug($name)
    ];
});

$factory->define(Template::class, function (Faker $faker) {

    $name = $faker->sentence(5);

    return [
        'type' => 'ad',
        'name' => $name,
        'slug' => str_slug($name)
    ];
}, 'ad');

$factory->define(Template::class, function (Faker $faker) {

    $name = $faker->sentence(5);

    return [
        'type' => 'page',
        'name' => $name,
        'slug' => str_slug($name)
    ];
}, 'page');