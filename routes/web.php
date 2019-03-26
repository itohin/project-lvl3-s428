<?php

$router->get('/', 'DomainController@index');

$router->get('/domains/{id}', 'DomainController@show');

$router->post('/domains', 'DomainController@store');
