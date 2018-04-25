<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Member;
use App\Division;
use App\Group;
use App\Policies\MemberPolicy;
use App\Policies\DivisionPolicy;
use App\Policies\GroupPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Member::class => MemberPolicy::class,
        Division::class => DivisionPolicy::class,
        Group::class => GroupPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-post', function($user, $post){
          return $user->id == $post->user_id;
        });
        Gate::define('update-post', 'PostPolicy@update');
        Gate::resource('posts', 'PostPolicy');

        
    }
}
