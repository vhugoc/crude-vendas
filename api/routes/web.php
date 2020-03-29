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

$router->group(['prefix' => 'api'], function () use ($router) {

    /**
     * User Routing
     * 
     */
    $router->post('/register', 'UserController@register');
    $router->post('/signin', 'UserController@signin');
    $router->get('/profile', ['middleware' => App\Http\Middleware\AuthorizationMiddleware::class, 'uses' => 'UserController@show']);

    /**
     * Sales Routing
     * 
     */
    $router->group(['prefix' => 'sale'], function () use ($router) {
        $router->get('/', ['middleware' => App\Http\Middleware\AuthorizationMiddleware::class, 'uses' => 'SaleController@index']);
        $router->get('/{id}', ['middleware' => App\Http\Middleware\AuthorizationMiddleware::class, 'uses' => 'SaleController@show']);
        $router->post('/', ['middleware' => App\Http\Middleware\AuthorizationMiddleware::class, 'uses' => 'SaleController@add']);
        $router->put('/{id}', ['middleware' => App\Http\Middleware\AuthorizationMiddleware::class, 'uses' => 'SaleController@update']);
        $router->delete('/{id}', ['middleware' => App\Http\Middleware\AuthorizationMiddleware::class, 'uses' => 'SaleController@delete']);
    });
});
