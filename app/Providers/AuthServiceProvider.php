<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

use Corp\Article;
use Corp\Permission;

use Corp\Policies\ArticlePolicy;
use Corp\Policies\PermissionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         
         Article::class => ArticlePolicy::class,
         Permission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('VIEW_ADMIN',function($user){
            return $user->canDo('VIEW_ADMIN',FALSE);
        });
        
        $gate->define('VIEW_ADMIN_ARTICLES',function($user){
            return $user->canDo('VIEW_ADMIN_ARTICLES',FALSE);
        });
        
        $gate->define('EDIT_USERS',function($user){
            return $user->canDo('EDIT_USERS',FALSE);
        });
        //
    }
}
