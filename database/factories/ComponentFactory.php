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
        'type' => $faker->randomElement(['text', 'image']),
        'rules'=> json_encode([])
    ];
});

$factory->define(Component::class, function (Faker $faker) {

    $template = factory(Template::class, 'ad')->create();

    $name = $faker->sentence(2);
   $rules['max_limit'] = 10; 
   $rules['min_limit'] = 5;

    return [
        'template_id' => $template->id,
        'order'       => 0,
        'name'        => $name,
        'slug'        => str_slug($name),
        'type'        => 'text',
        'rules'       => json_encode($rules)
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
        'type' => 'image',
        'rules'=> json_encode([
            'height' => 200, 
            'width' => 50
        ])
    ];
}, 'image');