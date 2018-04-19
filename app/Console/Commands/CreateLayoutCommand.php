<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Layout;
use App\User;
use App\Models\Role;

class CreateLayoutCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'layouts:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a layout interactively.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('This session will help you create a layout interactively.');
        
        $this->info('Currently, these are the layouts available.');
        $layouts = Layout::notDeleted()->latest()->get(['id', 'name', 'slug'])->toArray();
        $this->table(['ID', 'Name', 'slug'], $layouts);

        $name = $this->ask('What new layout do you want to create?');
        $layout = new Layout([
            'name' => $name,
            'slug' => str_slug($name),
            'user_id' => $this->getAnyAdmin()->id,
        ]);

        $this->info('Here\'s the layout you want to create:');
        $this->info('Name => ' . $layout->name);
        $this->info('Slug => ' . $layout->slug);

        if($this->confirm('Did I get you right? Proceed creating the layout?'))
        {
            $layout->save();
            
            $this->info('Successfully created the layout!');
        }
    }

    private function getAnyAdmin()
    {
        return Role::findBySlug('admin')->users->first();
    }
}
