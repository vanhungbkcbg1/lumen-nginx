<?php

namespace App\Providers;

use App\ApiUser;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Tymon\JWTAuth\JWTGuard;
use Tymon\JWTAuth\Providers\LumenServiceProvider;

class CustomLumenServiceProvider extends LumenServiceProvider
{
    /**
     * Extend Laravel's Auth.
     *
     * @return void
     */
    protected function extendAuthGuard()
    {
        $app =$this->app;
        //I will override user resolved of AuthManager
        $this->app['auth']->resolveUsersUsing(function () use ($app){
            //call to api head to get information of user base on token
//            $request=$app['request'];
            $token =$app['tymon.jwt.parser']->parseToken();
            $user =new ApiUser();
            return $user;
        });
        $this->app['auth']->extend('jwt', function ($app, $name, array $config) {

            $guard = new JWTGuard(
                $app['tymon.jwt'],
                $app['auth']->createUserProvider($config['provider']),
                $app['request']
            );

            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
    }
}
