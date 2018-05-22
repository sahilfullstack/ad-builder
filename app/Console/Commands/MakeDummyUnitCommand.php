<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Models\{Template, Unit};
use Carbon\Carbon;
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
        if(in_array($component->type, ["text", "qr"])) return $this->faker->sentence(6);

        if(in_array($component->type, ["image", "audio", "video"])) return $this->faker->imageUrl();
        
        if(in_array($component->type, ["images", "survey"])) return [$this->faker->imageUrl()];

        if($component->type == 'color') return sprintf('#%06X', mt_rand(0, 0xFFFFFF));;
    }
}
