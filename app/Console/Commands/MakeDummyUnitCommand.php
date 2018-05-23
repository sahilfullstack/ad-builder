<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Models\{Template, Unit};
use Carbon\Carbon, Storage;
use Faker\Generator as Faker;

class MakeDummyUnitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dummy-unit {template-slug} {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create dummy unit.';
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
        $templateSlug = $this->argument('template-slug');
        $count = $this->argument('count');

        for ($i=0; $i < $count ; $i++) { 
            $template = Template::where([
                'slug' => $templateSlug
                ])->first();

            if(is_null($template)) {
                $this->error("Tempate doesnot exist"); 
                die;
            }

            $user = User::inRandomOrder()->get()->first();        

            $components = $template->components;

            $componentValues = [];
            foreach ($components as $component) {
                $componentValues[$component->id] = $this->getFakeComponentValue($component);
            }

            Unit::create([
                'name'        => $this->faker->sentence(5),
                'user_id'     => $user->id,
                'template_id' => $template->id,
                'components'  => $componentValues,
                'layout_id'   => $template->layout_id,
                'type'        => 'ad'
            ]);

            $this->info("unit created for index ". $i);
        }

        $this->info("process completed ....");
    }

    protected function getFakeComponentValue($component)
    {
        if(in_array($component->type, ["text", "qr"])) return ["_value" => $this->faker->sentence(6)];

        if(in_array($component->type, ["image"])) return ["_value" => $this->dummyImage()];
        if(in_array($component->type, ["audio"])) return ["_value" => $this->dummyAudio()];
        if(in_array($component->type, ["video"])) return ["_value" => $this->dummyVideo()];
        
        if(in_array($component->type, ["images", "survey"])) return [ ["_value" => $this->dummyImage()], ["_value" => $this->dummyImage()]];

        if($component->type == 'color') return ["_value" => sprintf('#%06X', mt_rand(0, 0xFFFFFF))];
    }

    private function dummyImage()
    {
        return config('app.url') .'/storage/dummy/dummy-image.png';                
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