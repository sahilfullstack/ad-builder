<?php

use Faker\Generator as Faker;
use App\Models\Template;
use App\Models\Component;
use App\Models\Unit;

function get_fake_component_value(Component $component, Faker $faker)
{
    if($component->type == 'text') return $faker->sentence(6);

    if($component->type == 'image') return $faker->imageUrl();
}

$factory->define(Unit::class, function (Faker $faker) {

    $template = factory(Template::class)->create();

    $components = factory(Component::class)->times(5)->create(['template_id' => $template->id]);

    $componentValues = [];
    foreach($components as $component)
    {
        $componentValues[$component->slug] = get_fake_component_value($component, $faker);
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
        $componentValues[$component->slug] = get_fake_component_value($component);
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
        $componentValues[$component->slug] = get_fake_component_value($component);
    }

    return [
        'name' => $faker->sentence(5),
        'template_id' => $template->id,
        'components' => $componentValues
    ];
}, 'page');