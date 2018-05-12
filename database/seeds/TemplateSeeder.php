<?php

use Illuminate\Database\Seeder;
use App\Models\Template;
use App\Models\Layout;
use App\Models\Component;
use App\Models\Role;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #1',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-01',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #2',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-02',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #3',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-03',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #4',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-04',
                'components' => [
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #5',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-05',
                'components' => [
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #6',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-06',
                'components' => [
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #7',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-07',
                'components' => [
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ] 
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #7-2',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-07-02',
                'components' => [

                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #7-3',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-07-03',
                'components' => [

                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #1',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-01',
                'components' => [
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #2',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-02',
                'components' => [
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #3',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-03',
                'components' => [
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #4',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-04',
                'components' => [
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ]
                ]   
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #5',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-05',
                'components' => [
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #6',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-06',
                'components' => [
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #7',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-07',
                'components' => [
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #8',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-08',
                'components' => [
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #9',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-09',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #10',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-10',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #1',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-01',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #2',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-02',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #3',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-03',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #4',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-04',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #5',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-05',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #6',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-06',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #7',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-07',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #8',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-08',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #9',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-09',
                'components' => [
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #10',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-10',
                'components' => [
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ]
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #11',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-11',
                'components' => [
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #1',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-01',
                'components' => [   
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],                
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #2',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-02',
                'components' => [   
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],                   
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #3',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-03',
                'components' => [   
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],                   
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #4',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-04',
                'components' => [                   
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],     
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #5',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-05',
                'components' => [   
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],                   
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #6',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-06',
                'components' => [   
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],                
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #7',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-07',
                'components' => [ 
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ]                  
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #8',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-08',
                'components' => [ 
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ]                  
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #9',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-09',
                'components' => [ 
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],                    
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #10',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-10',
                'components' => [ 
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],                      
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #1',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-01',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],            
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #2',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-02',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],            
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #3',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-03',
                'components' => [
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ]            
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #4',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-04',
                'components' => [
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ]   
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #5',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-05',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],         
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #6',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-06',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],        
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #7',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-07',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],     
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #8',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-08',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],   
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #9',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-09',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],   
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #10',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-10',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],   
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #11',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-11',
                'components' => [
                   [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Quote Text',
                        'type' => 'text',
                        'rules' => []
                    ],                       
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #12',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-12',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 1',
                        'type' => 'image',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image 2',
                        'type' => 'image',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image 3',
                        'type' => 'image',
                        'rules' => []
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],    
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #13',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-13',
                'components' => [
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #1',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-01',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
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
                        'rules' => []
                    ],               
                    [
                        'name' => 'Survey',
                        'type' => 'survey',
                        'rules' => []
                    ],
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #2',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-02',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],
                    [
                        'name' => 'Timeline',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 1 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 2 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 3 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 1 Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 2 Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 3 Image',
                        'type' => 'image',
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
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Image',
                        'type' => 'image',
                        'rules' => []
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
                        'rules' => []
                    ],               
                    [
                        'name' => 'Slideshow',
                        'type' => 'images',
                        'rules' => []
                    ],
                    [
                        'name' => 'Blog Feed QR',
                        'type' => 'qr',
                        'rules' => []
                    ],
                    [
                        'name' => 'Blog Feed Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #4',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-04',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 3',
                        'type' => 'image',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image 1',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 2',
                        'type' => 'image',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Social Media 1 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 2 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 3 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 1 Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 2 Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 3 Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #5',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-05',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 1',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 2',
                        'type' => 'image',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image 3',
                        'type' => 'image',
                        'rules' => []
                    ],    
                    [
                        'name' => 'Image 4',
                        'type' => 'image',
                        'rules' => []
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
                        'name' => 'Slideshow',
                        'type' => 'images',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Social Media 1 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 2 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 3 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 1 Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 2 Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 3 Image',
                        'type' => 'image',
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
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
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
                        'rules' => []
                    ],               
                    [
                        'name' => 'Survey',
                        'type' => 'survey',
                        'rules' => []
                    ],
                    [
                        'name' => 'Slideshow',
                        'type' => 'images',
                        'rules' => []
                    ],
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #7',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-07',
                'components' => [
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #8',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-08',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Hero Video',
                        'type' => 'video',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image 1',
                        'type' => 'images',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image 2',
                        'type' => 'images',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ], 
                    [
                        'name' => 'Photogallery',
                        'type' => 'images',
                        'rules' => []
                    ], 
                    [
                        'name' => 'Social Media 1 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 2 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 3 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 1 Tttle',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 2 Tttle',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 3 Tttle',
                        'type' => 'text',
                        'rules' => []
                    ],

                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #9',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-09',
                'components' => [
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 1',
                        'type' => 'images',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image 2',
                        'type' => 'images',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 3',
                        'type' => 'images',
                        'rules' => []
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
                        'name' => 'Text 3',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 1 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 2 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Social Media 3 QR',
                        'type' => 'qr',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 1 Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 2 Image',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Social Media 3 Image',
                        'type' => 'image',
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
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => []
                    ],
                    [
                        'name' => 'Landing Page Title',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 1',
                        'type' => 'images',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image 2',
                        'type' => 'images',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 3',
                        'type' => 'images',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 4',
                        'type' => 'images',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image 5',
                        'type' => 'images',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 6',
                        'type' => 'images',
                        'rules' => []
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
                        'name' => 'Text 3',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text 4',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Text 5',
                        'type' => 'text',
                        'rules' => []
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
                        'rules' => []
                    ], 
                    [
                        'name' => 'Hours Of Operation',
                        'type' => 'text',
                        'rules' => []
                    ],       
                ]
            ],
        ];

        foreach ($templates as $template) {
            try {
                $found = Template::notDeleted()->whereSlug(str_slug($template['name']))->first();

                if ( ! is_null($found)) continue;

                $t = Template::create([
                    'type' => $template['type'],
                    'layout_id' => $template['layout_id'],
                    'name' => $template['name'],
                    'slug' => str_slug($template['name']),
                    'renderer' => $template['renderer'],
                    'user_id' => $this->getAnyAdmin()->id
                ]);

                foreach($template['components'] as $index => $component) {
                    try {
                        $c = Component::create([
                            'template_id' => $t->id,
                            'order'       => $index + 1,
                            'name'        => $component['name'],
                            'slug'        => str_slug($component['name']),
                            'type'        => $component['type'],
                            'rules'       => $component['rules']
                        ]);
                    }
                    catch(PDOException $e) {

                    }
                }

            } catch (PDOException $e) {
                
            }
        }
    }

    private function getAnyAdmin()
    {
        return Role::findBySlug('admin')->users->first();
    }
}