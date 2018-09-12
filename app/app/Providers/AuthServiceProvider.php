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


            if( $this->verifyAbility($ability) ){
                return $this->hasPermission($user, $ability);
            }

        });

    }

    // verifica se contém perm:
    //
    protected function verifyAbility($ability){

        $definitionPerm = explode(':', $ability);

        if( ! $definitionPerm[0] == 'perm' ){
            return false;
        }

        return false;
    }

    // verifica nas permissões que estão cadastradas no banco
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
