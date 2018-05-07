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
            'Full Page',
            'Half Page (Portrait)',
            'Half Page (Landscape)',
            'Quarter Page',
            '1/8th Page'
        ];

        foreach ($layouts as $layout) {
            try {
                $found = Layout::where([
                    'slug' => str_slug($layout),
                    'deleted_at_millis' => 0
                ])->first();

                if (!is_null($found)) continue;
                
                $l = Layout::create([
                    'name' => $layout,
                    'slug' => str_slug($layout),
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
