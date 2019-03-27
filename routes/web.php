<?php

$router->get('/', [
    'as' => 'domains.index', 'uses' => 'DomainController@index'
]);

$router->get('/domains/{id}', [
    'as' => 'domains.show', 'uses' => 'DomainController@show'
]);

$router->post('/domains', [
    'as' => 'domains.store', 'uses' => 'DomainController@store'
]);
