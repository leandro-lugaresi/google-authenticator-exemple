<?php

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

error_reporting(E_ALL /*^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT*/);

if (file_exists('vendor/autoload.php')) {
    $loader = include 'vendor/autoload.php';
} else {
    throw new RuntimeException('Unable to load the autoload. Run `php composer.phar install`.');
}

$routes = require 'config/routes.php';

$bootstrap = new \App\Bootstrap($routes);

return $bootstrap->run($bootstrap->getUrl());
