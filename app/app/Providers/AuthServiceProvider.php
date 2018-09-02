<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {

            return $this->hasPermission($user, $ability);

        });


        //
    }

    protected function hasPermission($user, $ability){

        $permissions = session('permissions');

        $definitionPerm = explode(':', $ability);

        if( ! $definitionPerm[0] == 'perm' ){
            return false;
        }

        $permissionName = $definitionPerm[1];

        if( !in_array($permissionName, $permissions) ){
            return false;
        }

        return true;

    }


}
