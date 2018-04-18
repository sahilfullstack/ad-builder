<?php

use Faker\Generator as Faker;
use App\Models\Layout;

$factory->define(Layout::class, function (Faker $faker) {

    $name = $faker->sentence(5);

    $user = App\User::first();

    return [
        'name' => $name,
        'slug' => str_slug($name),
        'user_id' => $user->id
    ];
});