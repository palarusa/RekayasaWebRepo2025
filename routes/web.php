<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});





// Buku Routes (public)
$router->get('/buku', 'ControllerBuku@index');
$router->get('/detail/{id}', 'ControllerBuku@detail');
$router->get('/update/{id}', 'ControllerBuku@update');
$router->get('/delete/{id}', 'ControllerBuku@delete');

$router->put('/update/{id}', 'ControllerBuku@update');
$router->delete('/delete/{id}', 'ControllerBuku@delete');

// Protected routes: hanya POST ke /buku yang butuh auth
$router->group(['middleware' => 'basicAuth'], function () use ($router) {
    $router->post('/buku','ControllerBuku@create');
});
