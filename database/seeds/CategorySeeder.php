<?php

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Advantage',
            'Headquarters',
            'History',
            'Mission',
            'Services',
            'Upgrades',
        ];

         foreach ($categories as $category) {
            try {
                $found = Category::where([
                    'slug' => str_slug($category)
                ])->first();

                if (!is_null($found)) continue;

                Category::create([
                    'name' => $category,
                    'slug' => str_slug($category)
                ]);

            } catch (PDOException $e) {
                
            }
        }
    }
}
