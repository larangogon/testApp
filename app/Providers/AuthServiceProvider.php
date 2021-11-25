<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('hasrole', function ($user) {
            if ($user->tieneRol()->count() > 0) {
                return true;
            }
            return false;
        });

        Gate::define('Administrator', function ($user) {
            return $user->hasRole('Administrator')
                ? Response::allow()
                : Response::deny('You must be a administrator.');
        });

        Gate::define('Guest', function ($user) {
            return $user->hasRole('Guest');
        });

        Gate::before(function ($user) {
            if ($user->hasRole('Administrator')) {
                return true;
            }
        });

    }
}
