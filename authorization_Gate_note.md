#### Gate được đăng kí trong class \Illuminate\Auth\AuthServiceProvider::registerAccessGate
````
 /**
     * Register the access gate service.
     *
     * @return void
     */
    protected function registerAccessGate()
    {
        $this->app->singleton(GateContract::class, function ($app) {
            return new Gate($app, function () use ($app) {
                return call_user_func($app['auth']->userResolver());
            });
        });
    }
````

#### thực hiện đăng kí policy trong \App\Providers\AuthServiceProvider::boot như sau
````
private function regisPolicy(){
        Gate::define("posts.create",PostPolicy::class."@create");
        Gate::define("posts.update",PostPolicy::class."@update");
        Gate::define("posts.delete",PostPolicy::class."@delete");
    }
````
#### hàm define trên sẽ gọi vào hàm \Illuminate\Auth\Access\Gate::define: trả lại callback , callback này được dùng khi gọi tới
#### hàm \Illuminate\Auth\Access\Gate::denies or \Illuminate\Auth\Access\Gate::allows
#### hàm allows trên sẽ gọi tới hàm \Illuminate\Auth\Access\Gate::raw, user sẽ được truyền vào callback ở trong hàm này
#### bên dưới là truyền user vào callback defined của ability
#### user được lấy từ userResolved closure của class AuthManager
````
if (is_null($result)) {
            $result = $this->callAuthCallback($user, $ability, $arguments);
        }
````
