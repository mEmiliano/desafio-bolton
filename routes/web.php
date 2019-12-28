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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('nota-fiscal/salvar', 'NotaFiscalController@salvarNotasFiscais');
$router->get('nota-fiscal', 'NotaFiscalController@listarNotasFiscais');
$router->get('nota-fiscal/{chave-acesso}', 'NotaFiscalController@listarPorChave');
