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

                ]
            ]
        ];

        foreach ($templates as $template) {
            try {
                $found = Template::notDeleted()->whereSlug(str_slug($template['name']))->first();

                if ( ! is_null($found)) continue;
                
                $t = Template::create([
                    'type' => 'ad',
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
