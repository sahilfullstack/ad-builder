<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use API;

class TestCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Confirmed Transactions For Btc Users';

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

        $template = {
            "type" => "ad",
            "name" => "Baba Template",
            "component" => {
                {
                    "order" => 0,
                    "name" => "First Component",
                    "type" => "text"
                ],
                {
                    "order" => 1,
                    "name" => "Second Component",
                    "type" => "image"
                ],
        ];
        API::post('user', array('title' => 'Demo'));
        dd("jell");
    }


}
