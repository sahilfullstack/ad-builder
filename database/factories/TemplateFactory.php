<?php

use Faker\Generator as Faker;
use App\Models\Template;
use App\Models\Layout;

$factory->define(Template::class, function (Faker $faker) {
    $layout = factory(Layout::class)->create();

    $name = $faker->sentence(5);

    return [
        'layout_id' => $layout->id,
        'type'      => $faker->randomElement(['ad', 'page']),
        'name'      => $name,
        'user_id'   => $layout->user_id,
        'slug'      => str_slug($name)
    ];
});

$factory->define(Template::class, function (Faker $faker) {
    $layout = factory(Layout::class)->create();

    $name = $faker->sentence(5);

    return [
        'layout_id' => $layout->id,
        'type'      => 'ad',
        'name'      => $name,
        'user_id'   => $layout->user_id,
        'slug'      => str_slug($name)
    ];
}, 'ad');

$factory->define(Template::class, function (Faker $faker) {
    $layout = factory(Layout::class)->create();

    $name = $faker->sentence(5);

    return [
        'layout_id' => $layout->id,
        'type'      => 'page',
        'name'      => $name,
        'user_id'   => $layout->user_id,
        'slug'      => str_slug($name)
    ];
}, 'page');