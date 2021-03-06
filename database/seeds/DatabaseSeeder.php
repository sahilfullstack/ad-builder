<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(LayoutsSeeder::class);
        $this->call(TemplateSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
