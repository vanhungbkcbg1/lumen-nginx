<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * @var $router Laravel\Lumen\Routing\Router
 */
$router->get('/index', function () use ($router) {
    return "Index action";
});

$router->get('/new-user', function () use ($router) {

    $user=new \App\Model\User();
    $user->name="hungnv";
    $user->address="Hoang Mai";
    $user->save();
    return "user created";
});

$router->get("/user-list",function () use ($router){
    $users=\App\Model\User::all();
    return json_encode($users);
});

$router->get('/', function () use ($router) {
    \Illuminate\Support\Facades\Log::info("hello");
    return $router->app->version();
});


