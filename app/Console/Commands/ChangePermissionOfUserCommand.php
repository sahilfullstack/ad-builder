<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Models\Role;

class ChangePermissionOfUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change-permission-of-user {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commands changes existing permission of user.';

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
        $user = $this->argument('user');

        $userFound = User::find($user);

        if(is_null($user)) 
        {
            $this->info("invalid user");
            exit();
        }

        if(! is_null($userFound->role))
        {
            $this->info("User is having role of a :". $userFound->role->name);
        } else {
            $this->info("User doesn't have any role yet.");
        }

        $this->info("Select id to Change the role");

        foreach (Role::notDeleted()->get() as $key => $role) {
            $this->info("id : " .$role->id. " name : ". $role->name);
        }

        $roleId = $this->ask("choose a id");

        $validRole = Role::notDeleted()->where('id', $roleId)->first();

        if(is_null($validRole)) 
        {
            $this->info("invalid role");
            exit();
        }

        $userFound->role_id = $roleId;
        $userFound->save();
    }
}
