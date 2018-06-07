<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use App\Models\Template;
use App\Models\Layout;
use App\Models\Component;
use App\Models\Role;


class AddRulesToTemplatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add-rules-to-templates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to add rules to templates.';

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
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('1/8th Page')],
                'name' => '1/8th Template #1',
                'renderer' => 'templates.renderers.1_8-ad-templates_480_540_v1-01',
                'components' => [
                    // [
                    //     'name' => 'Top Border Bar',
                    //     'type' => 'color',
                    //     'rules' => []
                    // ],
                    // [
                    //     'name' => 'Category Header Color',
                    //     'type' => 'color',
                    //     'rules' => []
                    // ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 306,
                            'height' => 333
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 306,
                            'height' => 114
                        ]
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 480,
                            'height' => 274
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 306,
                            'height' => 114
                        ]
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 480,
                            'height' => 274
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 480,
                            'height' => 288
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 306,
                            'height' => 114
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 480,
                            'height' => 288
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 306,
                            'height' => 114
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 480,
                            'height' => 518
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 480,
                            'height' => 518
                        ]
                    ]
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Quarter Page')],
                'name' => 'Quater Template #1',
                'renderer' => 'templates.renderers.quarter-page-ad-templates_960_1080_v1-01',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 328,
                            'height' => 294
                        ]
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 550,
                            'height' => 518
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 328,
                            'height' => 294
                        ]
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                         'rules' => [
                            'width'  => 550,
                            'height' => 518
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 960,
                            'height' => 519
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 960,
                            'height' => 519
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 960,
                            'height' => 289
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 394,
                            'height' => 124
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 960,
                            'height' => 289
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 394,
                            'height' => 124
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 550,
                            'height' => 519
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 328,
                            'height' => 294
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 550,
                            'height' => 519
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 328,
                            'height' => 294
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 328,
                            'height' => 118
                        ]
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 960,
                            'height' => 289
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 328,
                            'height' => 118
                        ]
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 960,
                            'height' => 289
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 680,
                            'height' => 184
                        ]
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1158,
                            'height' => 519
                        ]
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
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #2',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-02',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1158,
                            'height' => 519
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 680,
                            'height' => 184
                        ]
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
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #3',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-03',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 680,
                            'height' => 184
                        ],
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1158,
                            'height' => 519
                        ]
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
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #4',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-04',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1158,
                            'height' => 519
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 680,
                            'height' => 184
                        ]
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
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #5',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-05',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 680,
                            'height' => 519
                        ]
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1158,
                            'height' => 119
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
                    ]
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #6',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-06',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1158,
                            'height' => 519
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                         'rules' => [
                            'width'  => 680,
                            'height' => 119
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
                    ]
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #7',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-07',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                         'rules' => [
                            'width'  => 680,
                            'height' => 519
                        ]
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1158,
                            'height' => 119
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
                ]
            ],            
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #8',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-08',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1158,
                            'height' => 519
                        ]
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 680,
                            'height' => 119
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
                ]
            ],                     
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Landscape)')],
                'name' => 'Half Page (Landscape) #10',
                'renderer' => 'templates.renderers.half-page-landscape-ad-templates_1920_540-10',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1920,
                            'height' => 519
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1920,
                            'height' => 519
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],   
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 201
                        ]
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 960,
                            'height' => 590
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],   
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 201
                        ]
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 960,
                            'height' => 590
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],   
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 201
                        ]
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],                   
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 960,
                            'height' => 590
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],                   
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 201
                        ]
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 960,
                            'height' => 590
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],   
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 960,
                            'height' => 1059
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],   
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 960,
                            'height' => 1059
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ], 
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 960,
                            'height' => 590
                        ]
                    ],                  
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 201
                        ]
                    ],
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #8',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-08',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ], 
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 960,
                            'height' => 590
                        ]
                    ],                  
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 201
                        ]
                    ],
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Half Page (Portrait)')],
                'name' => 'Half Page (Portrait) #9',
                'renderer' => 'templates.renderers.half-page-portrait-ad-templates_960_1080_v1-09',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ], 
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 960,
                            'height' => 590
                        ]
                    ],               
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 201
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ], 
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 960,
                            'height' => 590
                        ]
                    ],               
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 201
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 539
                        ]
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1301,
                            'height' => 1059
                        ]
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
                'name' => 'Full Page #2',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-02',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1301,
                            'height' => 1059
                        ]
                    ],               
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 539
                        ]
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
                'name' => 'Full Page #3',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-03',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1920,
                            'height' => 1058
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1920,
                            'height' => 1058
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 539
                        ]
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1301,
                            'height' => 1059
                        ]
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
                'name' => 'Full Page #6',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-06',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1301,
                            'height' => 1059
                        ]
                    ],               
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 539
                        ]
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
                'name' => 'Full Page #7',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-07',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 970,
                            'height' => 220
                        ]
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1920,
                            'height' => 590
                        ]
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 362
                        ]
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1301,
                            'height' => 1059
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
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #9',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-09',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 1301,
                            'height' => 1059
                        ]
                    ],               
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 362
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
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #10',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-10',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 362
                        ]
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1301,
                            'height' => 1059
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
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #11',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-11',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width'  => 1301,
                            'height' => 1059
                        ]
                    ],               
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width'  => 409,
                            'height' => 362
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
                ]
            ],
            [
                'type' => 'ad',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Full Page #12',
                'renderer' => 'templates.renderers.full-page-ad-templates_1920x1080-12',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Category Header Color',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width' => 970,
                            'height' => 197
                        ]
                    ],
                    [
                        'name' => 'Image 1',
                        'type' => 'image',
                        'rules' => [
                            'width' => 606,
                            'height' => 590
                        ]
                    ],     
                    [
                        'name' => 'Image 2',
                        'type' => 'image',
                        'rules' => [
                            'width' => 606,
                            'height' => 590
                        ]
                    ],     
                    [
                        'name' => 'Image 3',
                        'type' => 'image',
                        'rules' => [
                            'width' => 606,
                            'height' => 590
                        ]
                    ],               
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],    
                ]
            ],
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
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #2',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-02',
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
                            'width' => 416,
                            'height' => 208
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
                        'rules' => []
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width' => 638,
                            'height' => 332
                        ]
                    ],
                    [
                        'name' => 'Timeline',
                        'type' => 'timeline',
                        'rules' => []
                    ],
                    [
                        'name' => 'Twitter URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Instagram URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Facebook URL',
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
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #4',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-04',
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
                        'name' => 'Image 1',
                        'type' => 'image',
                        'rules' => [
                            'width' => 658,
                            'height' => 319
                        ]
                    ],
                    [
                        'name' => 'Image 2',
                        'type' => 'image',
                        'rules' => [
                            'width' => 658,
                            'height' => 319
                        ]
                    ],
                    [
                        'name' => 'Image 3',
                        'type' => 'image',
                        'rules' => [
                            'width' => 658,
                            'height' => 319
                        ]
                    ],
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ],     
                    [
                        'name' => 'Twitter URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Instagram URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Facebook URL',
                        'type' => 'qr',
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
                        'name' => 'Slideshow',
                        'type' => 'images',
                        'rules' => [
                            'width' => 832,
                            'height' => 794
                        ]
                    ],     
                    [
                        'name' => 'Heading 1',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 1',
                        'type' => 'image',
                        'rules' => [
                            'width' => 420,
                            'height' => 183
                        ]
                    ],
                    [
                        'name' => 'Text 1',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Amount 1',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Heading 2',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Image 2',
                        'type' => 'image',
                        'rules' => [
                            'width' => 420,
                            'height' => 183
                        ]
                    ],     
                    [
                        'name' => 'Text 2',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Amount 2',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Twitter URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Instagram URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Facebook URL',
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
                    ]
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #7',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-07',
                'components' => [
                    [
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Custom Image',
                        'type' => 'image',
                        'rules' => [
                            'width' => 1920,
                            'height' => 1053
                        ]
                    ],
                ]
            ],
            [
                'type' => 'page',
                'layout_id' => $layouts[str_slug('Full Page')],
                'name' => 'Landing Page #8',
                'renderer' => 'templates.renderers.mesa_cec-landing-pages_1920_1080-08',
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
                            'width' => 412,
                            'height' => 149
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
                            'width' => 769,
                            'height' => 493
                        ]
                    ],     
                    [
                        'name' => 'Photo Gallery',
                        'type' => 'images',
                        'rules' => [
                            'width' => 142,
                            'height' => 123
                        ]
                    ], 
                    [
                        'name' => 'Video',
                        'type' => 'video',
                        'rules' => [
                            'width' => 684,
                            'height' => 493
                        ]
                    ],     
                    [
                        'name' => 'Text',
                        'type' => 'text',
                        'rules' => []
                    ], 
                    [
                        'name' => 'Image 2',
                        'type' => 'image',
                        'rules' => [
                            'width' => 526,
                            'height' => 268
                        ]
                    ],
                    [
                        'name' => 'QR Code Title 1',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'QR Code Value 1',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'QR Code Title 2',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'QR Code Value 2',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'QR Code Title 3',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'QR Code Value 3',
                        'type' => 'qr',
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
                        'name' => 'Top Border Bar',
                        'type' => 'color',
                        'rules' => []
                    ],
                    [
                        'name' => 'Logo',
                        'type' => 'image',
                        'rules' => [
                            'width' => 412,
                            'height' => 149
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
                            'width' => 572,
                            'height' => 414
                        ]
                    ],     
                    [
                        'name' => 'Image 2',
                        'type' => 'image',
                        'rules' => [
                            'width' => 572,
                            'height' => 414
                        ]
                    ],
                    [
                        'name' => 'Image 3',
                        'type' => 'image',
                        'rules' => [
                            'width' => 572,
                            'height' => 414
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
                        'name' => 'Text 3',
                        'type' => 'text',
                        'rules' => []
                    ],
                    [
                        'name' => 'Twitter URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Instagram URL',
                        'type' => 'qr',
                        'rules' => []
                    ],  
                    [
                        'name' => 'Facebook URL',
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
                        'type' => 'text',
                        'rules' => []
                    ]     
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
                           
                            $c->rules = $component['rules'];
                            $c->save();
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
