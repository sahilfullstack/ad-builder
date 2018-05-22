<?php

use Faker\Generator as Faker;
use App\Models\Template;
use App\Models\Component;
use App\Models\Unit;

function get_fake_component_value(Component $component, Faker $faker)
{
    if(in_array($component->type, ["text", "qr"])) return $faker->sentence(6);

    if(in_array($component->type, ["image", "audio", "video"])) return $faker->imageUrl();
    
    if(in_array($component->type, ["images", "survey"])) return [$faker->imageUrl()];

    if($component->type == 'color') return sprintf('#%06X', mt_rand(0, 0xFFFFFF));;
}

$factory->define(Unit::class, function (Faker $faker) {

    $template = factory(Template::class)->create();

    $components = factory(Component::class)->times(5)->create(['template_id' => $template->id]);

    $componentValues = [];
    foreach($components as $component)
    {
        $componentValues[$component->id] = get_fake_component_value($component, $faker);
    }

    return [
        'name' => $faker->sentence(5),
        'template_id' => $template->id,
        'components' => $componentValues
    ];
});

$factory->define(Unit::class, function (Faker $faker) {

    $template = factory(Template::class, 'ad')->create();

    $components = factory(Component::class)->times(5)->create(['template_id' => $template->id]);

    $componentValues = [];
    foreach ($components as $component) {
        $componentValues[$component->id] = get_fake_component_value($component);
    }

    return [
        'name' => $faker->sentence(5),
        'template_id' => $template->id,
        'components' => $componentValues
    ];
}, 'ad');

$factory->define(Unit::class, function (Faker $faker) {

    $template = factory(Template::class, 'page')->create();

    $components = factory(Component::class)->times(5)->create(['template_id' => $template->id]);

    $componentValues = [];
    foreach ($components as $component) {
        $componentValues[$component->id] = get_fake_component_value($component);
    }

    return [
        'name' => $faker->sentence(5),
        'template_id' => $template->id,
        'components' => $componentValues
    ];
}, 'page');

