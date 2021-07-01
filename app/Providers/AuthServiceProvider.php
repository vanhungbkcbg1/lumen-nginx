<?php

namespace App\Providers;

use App\Policies\ApiPostPolicy;
use App\Policies\PostPolicy;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use function foo\func;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        // viaRequest dung de extend Provider san co
        $this->app['auth']->viaRequest('api', function ($request) {
            //this function duoc dung de get thong tin cua user tu api_token
            // duoc goi toi khi ham guest duoc goi

            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });

        $this->regisPolicy();

    }

    private function regisPolicy(){
        Gate::define("posts.create",PostPolicy::class."@create");
        Gate::define("posts.update",PostPolicy::class."@update");
        Gate::define("posts.delete",PostPolicy::class."@delete");

        Gate::define("api.posts.create",ApiPostPolicy::class."@create");
        Gate::define("api.posts.update",ApiPostPolicy::class."@update");
        Gate::define("api.posts.delete",ApiPostPolicy::class."@delete");
    }
}
