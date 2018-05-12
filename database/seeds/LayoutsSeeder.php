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
            'Full Page' => [1920, 1080],
            'Half Page (Landscape)' => [1920, 540],
            'Half Page (Portrait)' => [960, 1080],
            'Quarter Page' => [960, 540],
            '1/8th Page' => [480, 540]
        ];

        foreach ($layouts as $layout => $dimensions) {
            try {
                $found = Layout::where([
                    'slug' => str_slug($layout),
                    'deleted_at_millis' => 0
                ])->first();

                if (!is_null($found)) continue;
                
                $l = Layout::create([
                    'name' => $layout,
                    'slug' => str_slug($layout),
                    'width' => $dimensions[0],
                    'height' => $dimensions[1],
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
