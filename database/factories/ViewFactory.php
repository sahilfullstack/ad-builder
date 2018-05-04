<?php

use Faker\Generator as Faker;

use App\Models\View;

$factory->define(View::class, function (Faker $faker) {
    return [
        'unit_id' => $faker->numberBetween(1, 100),
        'viewed_at' => $faker->dateTimeThisMonth('now'),
        'duration' => $faker->numberBetween(5, 120),
        'category_id' => $faker->numberBetween(1, 25),
        'landing_from' => $faker->randomElement(['category', 'slideshow', 'alphabet', 'navigation'])
    ];
});
