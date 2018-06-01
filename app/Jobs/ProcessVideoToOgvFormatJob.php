<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Unit;
use FFMpeg;

class ProcessVideoToOgvFormatJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $unit;
    protected $componentId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Unit $unit, $componentId)
    {
        $this->unit        = $unit;
        $this->componentId = $componentId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ffmpeg = FFMpeg\FFMpeg::create();
        
        $components = $this->unit->components;

        foreach ($components as $key => $component)
        {    
            if($key == $this->componentId)
            {
                $videoName = md5(microtime());
                $path = public_path() .'/storage/uploads/'. $videoName .'.ogv';
                $ffmpeg->open($component['_value'])
                    ->save(new \FFMpeg\Format\Video\Ogg(), $path);
                $components[$key]["converted_value"] = config('app.url').'/storage/uploads/'. $videoName .'.ogv';
            }  
        }

        $this->unit->components = $components;
        $this->unit->save();
    }
}
