<?php

ini_set('display_errors', 1);
error_reporting(E_ERROR);

define('ROOT', __DIR__);

require ROOT . '/../vendor/autoload.php';
require ROOT . '/config/constants.php';
require ROOT . '/lib/DdPe.php';
require ROOT . '/lib/Logging.php';

$configuration = require ROOT . '/config/slim_cfg.php';
$app = new \Slim\App($configuration);

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withHeader('Content-Type', 'application/json');
});

require ROOT . '/config/router/routes.php';

$app->run();