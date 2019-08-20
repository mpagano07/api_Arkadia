<?php

$router->post('/users/login', ['uses' => 'UsersController@login']);
$router->post('/users', ['uses' => 'UsersController@createUser']);
$router->get('/users', ['uses' => 'UsersController@index']);
$router->get('/home', ['uses' => 'UsersController@index']);

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function () {
    return str_random(32);
});