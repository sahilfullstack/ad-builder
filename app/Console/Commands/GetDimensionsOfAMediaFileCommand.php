<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FFMpeg;
use App\Rules\ValidComponents;
use App\Models\{Component, Template};

class GetDimensionsOfAMediaFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-dimensions-of-a-media-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commands get dimension of a media file.';

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
        // $this->playWithImage();
        // $this->validateComponents();
        $this->playWithVideo();
    }

    private function validateComponents()
    {
        $components = ["quia omnis." => "sasa asa s a as a s as a s a sa s"];
        $order = 0;
        foreach ($components as $key => $value) 
        {
            $component = Component::where('template_id', 27)->where('order', $order)->first();

            $rules = json_decode($component->rules, true);

            foreach ($rules as $ruleKey => $ruleValue) 
            {        
                $key = str_replace('.', '-', $key);        
                $validator = \Validator::make([$key => $value], [
                    $key => [
                        new ValidComponents($component->type, $ruleKey, $ruleValue)
                    ]
                ]);

                if ($validator->fails()) {
                    dd("here");
                    throw InvalidInputException($validator->errors()->first());
                }   

                dD("eee");
            }

            ++$order;
        }
    }

    private function playWithImage()
    {
        dd(getImageSize(resource_path("test_image.jpg")));
    }

    private function playWithVideo()
    {
        $ffmpeg = FFMpeg\FFMpeg::create();

        // $dimension = $ffmpeg->open("https://www.youtube.com/watch?v=3N3n23loy24")
        $dimension = $ffmpeg->open(resource_path("test_video.mp4"))
            ->getStreams()
            ->videos()
            ->first()
            ->getDimensions();

        // dd($dimension->getWidth());
        // dd($dimension->getHeight());

        $ffprobe = FFMpeg\FFProbe::create();
        // code gets duration of a video
        $duration = $ffprobe
            ->format(resource_path("test_video.mp4")) // extracts file informations
            ->get('duration');             // returns the duration property

        dd($duration);
    }
}
