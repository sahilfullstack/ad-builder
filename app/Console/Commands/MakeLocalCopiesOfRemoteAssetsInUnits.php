<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Unit;
use App\Models\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MakeLocalCopiesOfRemoteAssetsInUnits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unit:fetch-remote-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches the remotely hosted assets.';

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
        $units = Unit::notDeleted()->get();

        foreach($units as $unit)
        {
            $updatedComponents = [];

            foreach($unit->components as $componentId => $componentValue)
            {
                $component = Component::find($componentId);
                if(
                    in_array($component->type, ['image', 'images', 'video', 'audio'])
                    &&
                    ! empty($componentValue['_value'])
                    &&
                    filter_var($componentValue['_value'], FILTER_VALIDATE_URL)
                    && 
                    ! starts_with($componentValue['_value'], url()->to('/'))
                )
                {
                    $updatedComponents[$component->id] = $unit->components[$componentId];

                    if($component->type == 'images')
                    {
                        dd('here');
                        foreach($componentValue as $componentIndex => $componentIndexValue)
                        {
                            $newUrl = $this->saveFromRemote($componentIndexValue['_value']);
                            $updatedComponents[$component->id][$componentIndex]['_value'] = $newUrl;
                        }
                    } else {
                        $newUrl = $this->saveFromRemote($componentValue['_value']);
    
                        $updatedComponents[$component->id]['_value'] = $newUrl;
                    }
                }
            }
            var_dump($updatedComponents);
            // $unit->update(['components' => array_replace($unit->components, $updatedComponents)]);
        }
    }

    protected function saveFromRemote($urls, $isArray = false)
    {
        if( ! $isArray) $urls = [$urls];
        
        foreach($urls as $url)
        {
            $this->info('Saving... ' . $url);
            $contents = file_get_contents($url);
            $name = md5($contents);
            
            Storage::put(config('uploads.folder') . '/' . $name, $contents);
    
            return Storage::url(config('uploads.folder') . '/' . $name, $contents);
        }
    }
}
