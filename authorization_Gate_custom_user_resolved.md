#### de custom user resolved, sử dụng trong authrozation microservice
#### trong viec khoi tao cua Gate thì nó sẽ dùng tới function \Illuminate\Auth\AuthManager::$userResolver
#### do đó để custom lại cách lấy user thì ta sẽ làm như sau
#### tạo class extend từ \Tymon\JWTAuth\Providers\LumenServiceProvider và override lại method extendAuthGuard như sau
````
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
````
