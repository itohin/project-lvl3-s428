<?php

$router->get('/', ['as' => 'home', function () {
    return view('home');
}]);

$router->get('/domains', [
    'as' => 'domains.index', 'uses' => 'DomainController@index'
]);

$router->get('/domains/{id}', [
    'as' => 'domains.show', 'uses' => 'DomainController@show'
]);

$router->post('/domains', [
    'as' => 'domains.store', 'uses' => 'DomainController@store'
]);
