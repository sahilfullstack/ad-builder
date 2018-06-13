<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Models\{Template, Unit};
use Carbon\Carbon, Storage;
use Faker\Generator as Faker;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class MakeDummyUnitForAllTemplatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dummy-unit-for-all-templates {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create dummy units for all templates.';
    protected $faker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Faker $faker)
    {
        parent::__construct();

        $this->faker = $faker;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $adTemplates = Template::ad()->get();
        $pageTemplates = Template::page()->get();

        $pageIndex = 0;
        foreach ($adTemplates as $key => $template)
        {
            $user = User::inRandomOrder()->get()->first();

            $ad = Unit::create([
                'name'        => $this->faker->sentence(5),
                'user_id'     => $user->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'template_id' => $template->id,
                'components'  => $this->makeComponents($template),
                'experimental_components'  => $this->makeComponents($template),
                'is_holder'   => false,
                'layout_id'   => $template->layout_id,
                'type'        => $template->type,
                'parent_id'   => null
            ]);
            
            $pageTemplate = $pageTemplates->get($pageIndex);
            Unit::create([
                'name'        => $this->faker->sentence(5),
                'user_id'     => $user->id,
                'template_id' => $pageTemplate->id,
                'components'  => $this->makeComponents($pageTemplate),
                'experimental_components'  => $this->makeComponents($pageTemplate),
                'is_holder'   => false,
                'layout_id'   => $pageTemplate->layout_id,
                'type'        => $pageTemplate->type,
                'parent_id'   => $ad->id
            ]);

            $pageIndex++;

            if($pageIndex >= $pageTemplates->count()) $pageIndex = 0;
        }

        // publishing landing page for each ad.
        // $ads = Unit::ad()->get();
        // $pageTemplates = Template::page()->get();
        // $index = 0;
        // foreach($ads as $ad)
        // {
        //     $user = User::inRandomOrder()->get()->first();        
        //     $template = $pageTemplates->get($index);

        //     Unit::create([
        //         'name'        => $this->faker->sentence(5),
        //         'user_id'     => $user->id,
        //         'template_id' => $template->id,
        //         'components'  => $this->makeComponents($template),
        //         'layout_id'   => $template->layout_id,
        //         'type'        => $template->type,
        //         'parent_id'   => $ad->id
        //     ]);

        //     $index++;

        //     if($index >= $pageTemplates->count()) $index = 0;
        // }

        DB::table('units')->update(['published_at' => Carbon::now(), 'approved_at' => Carbon::now()]);

        $this->info("process completed ....");
    }

    protected function makeComponents(Template $template)
    {
        $components = $template->components;

        $componentValues = [];
        foreach ($components as $component) {
            $componentValues[$component->id] = $this->getFakeComponentValue($component);
        }

        return $componentValues;
    }

    protected function getFakeComponentValue($component)
    {
        if(in_array($component->type, ["text", "qr"])) return ["_value" => $this->faker->sentence(6)];

        if(in_array($component->type, ["image"])) return ["_value" => $this->dummyImage()];
        if(in_array($component->type, ["audio"])) return ["_value" => $this->dummyAudio()];
        if(in_array($component->type, ["video"])) return ["_value" => $this->dummyVideo()];
        
        if(in_array($component->type, ["images"])) return [ ["_value" => $this->dummyImage()], ["_value" => $this->dummyImage2()]];
        if(in_array($component->type, ["survey"])) return [
                    '_value' => [ 
                        'title'            => [ '_value' => '',  'background_color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)), 'foreground_color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)), 'size' => 12 ], 
                        'question'         => [ '_value' => '', 'foreground_color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)), 'size' => 12 ], 
                        'box_color'        => sprintf('#%06X', mt_rand(0, 0xFFFFFF)), 
                        'yes_button_color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)), 
                        'no_button_color'  => sprintf('#%06X', mt_rand(0, 0xFFFFFF))
                    ], 
                    '_yes' => 0, 
                    '_no' => 0 
                ];

        if($component->type == 'color') return ["_value" => sprintf('#%06X', mt_rand(0, 0xFFFFFF))];
        
        if($component->type == 'timeline') return ['_value' => [
                    'title' => $this->faker->sentence(10),
                    'values' => [
                        [
                            'month' => 'June',
                            'year' => '2018',
                            'description' => $this->faker->sentence(10),
                            'image' => $this->dummyImage()
                        ],
                      [
                            'month' => 'July',
                            'year' => '2018',
                            'description' => $this->faker->sentence(10),
                            'image' => $this->dummyImage()
                        ],
                        [
                            'month' => 'August',
                            'year' => '2018',
                            'description' => $this->faker->sentence(10),
                            'image' => $this->dummyImage()
                        ],[
                            'month' => 'September',
                            'year' => '2018',
                            'description' => $this->faker->sentence(10),
                            'image' => $this->dummyImage()
                        ],
                    ]
                ]];

        if($component->type == 'hours_of_operation') return ['_value' => [
                    'title' => $this->faker->sentence(10),
                    'values' => [
                        [
                            'day' => 'Day 1',
                            'open' => 'Day OT',
                            'close' => 'Day CT'
                        ]
                    ]
                ]];

        return ["_value" => $this->faker->sentence(6)];
    }

    private function dummyImage()
    {
        return config('app.url') .'/storage/dummy/dummy-image.png';                
    }

    private function dummyImage2()
    {
        return config('app.url') .'/storage/dummy/dummy-image2.png';                
    }

    private function dummyAudio()
    {
        return config('app.url') .'/storage/dummy/dummy-audio.ogg';        
    }

    private function dummyVideo()
    {
        return config('app.url') .'/storage/dummy/dummy-video.ogv';
    }

    protected function saveFromRemote($url)
    {
        $this->info('Saving... ' . $url);
        $contents = file_get_contents($url);
        $name = md5($contents);
        Storage::put(config('uploads.folder') . '/' . $name, $contents);

        return Storage::url(config('uploads.folder') . '/' . $name, $contents);
    }
}
