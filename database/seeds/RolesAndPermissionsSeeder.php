<?php

use App\Models\{Role, Permission};
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->createRoles();
    	
    	$this->createPermissions();

    	$this->bindRolesWithPermissions();
    }

    private function createRoles()
    {
        $roles = config('auth.roles');

        foreach($roles as $slug => $role)
        {
            try
            {
                $roleFound = Role::where([
                    'slug' => $slug,
                    'deleted_at_millis' => 0
                    ])->first();

                if(! is_null($roleFound)) continue;

                Role::create([
                    'name' => $role['name'],
                    'slug' => $slug,
                    'priority' => $role['priority']
                ]);
            }
            catch(PDOException $e)
            {
                // do nothing
            }
        }
    }

    private function createPermissions()
    {
    	$permissions = config('auth.permissions');

        foreach($permissions as $slug => $permission)
        {
            try
            {
                $permissionFound = Permission::where([
                    'slug' => $slug,
                    'deleted_at_millis' => 0
                    ])->first();

                if(! is_null($permissionFound)) continue;

                Permission::create([
                    'name' => $permission['name'],
                    'slug' => $slug
                ]);
            }
            catch(PDOException $e)
            {
                // do nothing
            }
        }
    }

    private function bindRolesWithPermissions()
    {
    	$roles = config('auth.roles');

        foreach($roles as $slug => $role)
        {
            $permissions = Permission::notDeleted()
                ->whereIn('slug', config("auth.roles.$slug.permissions"))
                ->get();

            foreach($permissions as $permission)
            {
                try
                {
                    Role::notDeleted()->whereSlug($slug)->first()->permissions()->syncWithoutDetaching($permission);
                }
                catch(PDOException $e)
                {
                    // do nothing
                }
            }
        }
    }
}
