<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use App\Models\{Template, Unit};
use App\Policies\{TemplatePolicy, UnitPolicy};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Template::class => TemplatePolicy::class,
        Unit::class => UnitPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        
        //
    }

    public function register()
    {
        $this->registerGates();
    }

    /**
     * Register a gate for each permission.
     *
     * @return void
     */
    protected function registerGates()
    {
        foreach (config('auth.permissions') as $slug => $permission)
        {
            Gate::define($slug, function($user) use ($slug)
            {
                return $user->hasPermission($slug);
            });
        }
    }
}
