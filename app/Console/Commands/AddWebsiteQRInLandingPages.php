<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{Unit, Layout, Template, Component};

class AddWebsiteQRInLandingPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add-website-qr-in-landing-pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refactor components structure in units.';

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
        $layouts = [
            str_slug('Full Page') => Layout::notDeleted()->whereSlug(str_slug('Full Page'))->first()->id,
            str_slug('Half Page (Portrait)') => Layout::notDeleted()->whereSlug(str_slug('Half Page (Portrait)'))->first()->id,
            str_slug('Half Page (Landscape)') => Layout::notDeleted()->whereSlug(str_slug('Half Page (Landscape)'))->first()->id,
            str_slug('Quarter Page') => Layout::notDeleted()->whereSlug(str_slug('Quarter Page'))->first()->id,
            str_slug('1/8th Page') => Layout::notDeleted()->whereSlug(str_slug('1/8th Page'))->first()->id,
        ];

        $templates = [
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #1',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-01',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width' => 387,
                            'height' => 149
                        ]
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width' => 769,
                            'height' => 765
                        ]
                    ],     
                    [
                        'name' => 'Text 1',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text 2',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Map Title',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Map',
                        'type' => 'image',
                        'rules' => [
                            'width' => 373,
                            'height' => 41
                        ]
                    ], 
                    [
                        'name' => 'Survey',
                        'type' => 'survey',
                        'rules' => []
                    ],
                    [
                        'name' => 'Website URL',
                        'type' => 'qr',
                        'rules' => []
                    ],                
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #3',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-03',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width' => 387,
                            'height' => 149
                        ]
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Slideshow',
                        'type' => 'images',
                        'rules' => [
                            'width' => 1199,
                            'height' => 561
                        ]
                    ],
                    [
                        'name' => 'Text 1',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text 2',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Map Title',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Map',
                        'type' => 'image',
                        'rules' => [
                            'width' => 372,
                            'height' => 157
                        ]
                    ],
                    [
                        'name' => 'Audio',
                        'type' => 'audio',
                        'rules' => []
                    ],          
                    [
                        'name' => 'Blog Feed URL',
                        'type' => 'qr',
                        'rules' => []
                    ],
                    [
                        'name' => 'Website URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #6',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-06',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width' => 414,
                            'height' => 207
                        ]
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width' => 982,
                            'height' => 554
                        ]
                    ],     
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ], 
                    [
                        'name' => 'Map Title',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Map',
                        'type' => 'image',
                        'rules' => [
                            'width' => 372,
                            'height' => 157
                        ]
                    ],    
                    [
                        'name' => 'Survey',
                        'type' => 'survey',
                        'rules' => []
                    ],
                    [
                        'name' => 'Slideshow',
                        'type' => 'images',
                        'rules' => [
                            'width' => 396,
                            'height' => 412
                        ]
                    ],
                    [
                        'name' => 'Website URL',
                        'type' => 'qr',
                        'rules' => []
                    ],      
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #10',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-10',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width' => 414,
                            'height' => 229
                        ]
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 1',
                        'type' => 'image',
                        'rules' => [
                            'width' => 235,
                            'height' => 170
                        ]
                    ],     
                    [
                        'name' => 'Text 1',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 2',
                        'type' => 'image',
                        'rules' => [
                            'width' => 235,
                            'height' => 170
                        ]
                    ],
                    [
                        'name' => 'Text 2',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 3',
                        'type' => 'image',
                        'rules' => [
                            'width' => 235,
                            'height' => 170
                        ]
                    ],
                    [
                        'name' => 'Text 3',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 4',
                        'type' => 'image',
                        'rules' => [
                            'width' => 235,
                            'height' => 170
                        ]
                    ],     
                    [
                        'name' => 'Text 4',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 5',
                        'type' => 'image',
                        'rules' => [
                            'width' => 235,
                            'height' => 170
                        ]
                    ],
                    [
                        'name' => 'Text 5',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 6',
                        'type' => 'image',
                        'rules' => [
                            'width' => 235,
                            'height' => 170
                        ]
                    ],
                    [
                        'name' => 'Text 6',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Map Title',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Map',
                        'type' => 'image',
                        'rules' => [
                            'width' => 372,
                            'height' => 157
                        ]
                    ], 
                    [
                        'name' => 'Hours Of Operation',
                        'type' => 'hours_of_operation',
                        'rules' => []
                    ],    
                    [
                        'name' => 'Website URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                ]
            ]
        ];

          // here we will seed the rules of the templates in the database
        foreach ($templates as $template) {
            try {
                $t = Template::notDeleted()->whereSlug(str_slug($template['name']))->first();

                if($t)
                {                
                    foreach($template['components'] as $index => $component) {
                        try {
                            $c = Component::where([
                                'template_id' => $t->id,
                                'order'       => $index + 1,
                                'name'        => $component['name'],
                                'slug'        => str_slug($component['name']),
                                'type'        => $component['type']
                            ])->first();                           
                            
                            if(is_null($c))
                            {
                                $c = Component::create([
                                    'template_id' => $t->id,
                                    'order'       => $index + 1,
                                    'name'        => $component['name'],
                                    'slug'        => str_slug($component['name']),
                                    'type'        => $component['type'],
                                    'rules'       => $component['rules']
                                ]);

                            }
                        }
                        catch(PDOException $e) {
                            $this->info($e->getMessage());
                        }
                    }
                }


            } catch (PDOException $e) {
                
            }
        }
    }
}
