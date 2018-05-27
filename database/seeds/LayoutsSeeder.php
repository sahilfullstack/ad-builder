<?php

use Illuminate\Database\Seeder;
use App\Models\Layout;
use App\Models\Role;

class LayoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $layouts = [
            'Full Page' => [1920, 1080, null, null], // 1
            'Half Page (Landscape)' => [1920, 540, null, null], // 2
            'Half Page (Portrait)' => [960, 1080, null, null], // 3
            'Quarter Page' => [960, 540, null, null], // 4
            '1/8th Page' => [480, 540, null, null], // 5
            
            // Sub-layouts
            '1/2(P) - 1/2(P)' => [1920, 1080, 1, '33'],
            '1/4 - 1/4 - 1/4 - 1/4' => [1920, 1080, 1, '4444'],
            '1/4 - 1/4 - 1/2(L)' => [1920, 1080, 1, '442'],
            '1/8 - 1/8 - 1/8 - 1/8 - 1/4 - 1/4' => [1920, 1080, 1, '55554'],
            '1/4 - 1/4 - 1/4 - 1/8 - 1/8' => [1920, 1080, 1, '44455'],
            '1/2(L) - 1/2(L)' => [1920, 1080, 1, '22'],
            '1/2(L) - 1/4 - 1/4' => [1920, 1080, 1, '244'],
            '1/2(P) - 1/4 - 1/4' => [1920, 1080, 1, '344'],
            '1/4 - 1/2(P) - 1/4' => [1920, 1080, 1, '434'],
            '1/4 - 1/4 - 1/8 - 1/8 - 1/8 - 1/8' => [1920, 1080, 1, '445555'],
            '1/4 - 1/8 - 1/8 - 1/4 - 1/4' => [1920, 1080, 1, '45544'],
            '1/8 - 1/8 - 1/8 - 1/8 - 1/8 - 1/8 - 1/8 - 1/8' => [1920, 1080, 1, '55555555'],
            '1/8 - 1/8 - 1/8 - 1/8 - 1/2(L)' => [1920, 1080, 1, '55552'],
            '1/2(L) - 1/8 - 1/8 - 1/8 - 1/8' => [1920, 1080, 1, '25555'],
            '1/2(P) - 1/8 - 1/8 - 1/8 - 1/8' => [1920, 1080, 1, '35555'],
            '1/8 - 1/8 - 1/2(P) - 1/8 - 1/8' => [1920, 1080, 1, '55444'],
            '1/8 - 1/8 - 1/4 - 1/4 - 1/4' => [1920, 1080, 1, '55444'],
            '1/2(P) - 1/8 - 1/8 - 1/4' => [1920, 1080, 1, '3554'],
            '1/4 - 1/2(P) - 1/8 - 1/8' => [1920, 1080, 1, '4355'],
            '1/2(P) - 1/4 - 1/8 - 1/8' => [1920, 1080, 1, '3455'],
            '1/8 - 1/8 - 1/2(P) - 1/4' => [1920, 1080, 1, '5534'],
            '1/4 - 1/4 - 1/8 - 1/8 - 1/4' => [1920, 1080, 1, '44554'],
        ];

        foreach ($layouts as $layout => $attributes) {
            try {
                $found = Layout::where([
                    'slug' => str_slug($layout),
                    'deleted_at_millis' => 0
                ])->first();

                if (!is_null($found)) continue;
                
                $l = Layout::create([
                    'name' => $layout,
                    'slug' => str_slug($layout),
                    'width' => $attributes[0],
                    'height' => $attributes[1],
                    'parent_id' => $attributes[2],
                    'contents' => $attributes[3],
                    'user_id' => $this->getAnyAdmin()->id
                ]);
            } catch (PDOException $e) {
                
            }
        }
    }

    private function getAnyAdmin()
    {
        return Role::findBySlug('admin')->users->first();
    }
}
