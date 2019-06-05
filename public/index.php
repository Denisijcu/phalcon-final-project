<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;

// Define some absolute path
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();
$loader->registerDirs([
	APP_PATH . '/controllers/',
	APP_PATH . '/models/',
]);
$loader->register();


// Create a DI
$di = new FactoryDefault();


/*

$di->setShared(
    'session',
    function () {
        $session = new Session();

        $session->start();

        return $session;
    }
);
*/

// Setup the view component
$di->set('view', function () {
	$view = new View();
	$view->setViewsDir(APP_PATH . '/views/');
	$view->setLayoutsDir(APP_PATH . '/layouts/');
	return $view;
});

// connect to the database
$di->set('db', function () {
	return new Mysql([
		"host" => "localhost",
		"username" => "root",
		"password" => "",
		"dbname" => "collection"
	]);
});

$application = new Application($di);
$response = $application->handle();
$response->send();