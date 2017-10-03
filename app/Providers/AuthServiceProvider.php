<?php

namespace App\Providers;

use App\Model\Blog\Post;
use App\Policies\PostPolicy;
use App\Model\Controller\User;
use App\Model\Controller\Permission;
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
       /// Post::class => PostPolicy::class,
        
    ];

    /**return $user->id == $post->user_id;
            });
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $permissions = Permission::with('roles')->get();
        foreach ($permissions as $permission){
            Gate::define($permission->name, function (User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
        
       /* Gate::define('update-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });*/
        Gate::before(function(User $user, $ability){
            if($user->hasAnyRoles('Administrador'))
                return true;
        });
    }
}
