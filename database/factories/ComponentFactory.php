<?php

use Faker\Generator as Faker;
use App\Models\Template;
use App\Models\Component;

$factory->define(Component::class, function (Faker $faker) {

    $template = factory(Template::class, 'ad')->create();

    $name = $faker->sentence(2);

    return [
        'template_id' => $template->id,
        'order' => 0,
        'name' => $name,
        'slug' => str_slug($name),
        'type' => $faker->randomElement(['text', 'image'])
    ];
});

$factory->define(Component::class, function (Faker $faker) {

    $template = factory(Template::class, 'ad')->create();

    $name = $faker->sentence(2);

    return [
        'template_id' => $template->id,
        'order' => 0,
        'name' => $name,
        'slug' => str_slug($name),
        'type' => 'text'
    ];
}, 'text');

$factory->define(Component::class, function (Faker $faker) {

    $template = factory(Template::class, 'ad')->create();

    $name = $faker->sentence(2);

    return [
        'template_id' => $template->id,
        'order' => 0,
        'name' => $name,
        'slug' => str_slug($name),
        'type' => 'image'
    ];
}, 'image');