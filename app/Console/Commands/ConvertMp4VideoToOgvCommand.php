<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FFMpeg;
use App\Jobs\ProcessAudioToOggFormatJob;

class ConvertMp4VideoToOgvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert-mp4-video-to-ogv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to convert mp4 video to ogv.';

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
        \Log::info("before starting the job");
        ProcessAudioToOggFormatJob::dispatch();
        \Log::info("after starting the job");
        // $this->goForVideo();
        // $this->goForAudio();
    }

    private function goForAudio()
    {
        $ffmpeg = FFMpeg\FFMpeg::create();

        $dimension = $ffmpeg->open(config('app.url') .'/storage/dummy/dummy-audio.mp3')
            ->save(new \FFMpeg\Format\Video\Ogg(), storage_path().'/app/uploads/aa.ogg');

    }

    private function goForVideo()
    {
        $ffmpeg = FFMpeg\FFMpeg::create();

        $dimension = $ffmpeg->open(config('app.url') .'/storage/dummy/dummy-video.mp4')
            ->save(new \FFMpeg\Format\Video\Ogg(), storage_path() .'/app/uploads/prograam.ogv');
    }
}