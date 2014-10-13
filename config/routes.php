<?php

return array(
    'home' => array(
        'route' => '/',
        'controller' => 'index',
        'action' => 'index'
    ),
    'login' => array(
        'route' => '/user/login',
        'controller' => 'user',
        'action' => 'login'
    ),
    'logout' => array(
        'route' => '/user/logout',
        'controller' => 'user',
        'action' => 'logout'
    ),
    'activate' => array(
        'route' => '/user/activate',
        'controller' => 'user',
        'action' => 'activate'
    ),
    'verify' => array(
        'route' => '/user/verify',
        'controller' => 'user',
        'action' => 'verify'
    ),
    'create-user' => array(
        'route' => '/user/create',
        'controller' => 'user',
        'action' => 'create'
    ),
    'list-user' => array(
        'route' => '/user',
        'controller' => 'user',
        'action' => 'index'
    )

);
