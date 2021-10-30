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
    die('ok');
});


$router->post('/dono', 'DonoController@create');
$router->get('/dono', 'DonoController@index');
$router->get('/dono/{id}', 'DonoController@find');
$router->put('/dono/{id}', 'DonoController@update');
$router->delete('/dono/{id}', 'DonoController@delete');

$router->post('/animal', 'AnimalController@create');
$router->put('/animal/{id}', 'AnimalController@update');
$router->delete('/animal/{id}', 'AnimalController@delete');
$router->get('/animal', 'AnimalController@index');
$router->get('/animal/{id}', 'AnimalController@find');

$router->post('/servico', 'ServicoController@create');
$router->put('/servico/{id}', 'ServicoController@update');
$router->delete('/servico/{id}', 'ServicoController@delete');
$router->get('/servicos', 'ServicoController@index');
$router->get('/servico/{id}', 'ServicoController@findById');