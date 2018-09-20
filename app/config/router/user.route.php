<?php

use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;

// SIGNUP ROUTE
$app->group('/user/data', function () use ($app) {

    $userGetDataValidator = [
        'access_token' => v::notEmpty()
    ];
    $app->get('[/]', \Controllers\UserController::class . ':get')
        ->add(new \Middleware\JWT\SimpleAuth())
        ->add(new Validation($userGetDataValidator));
    // end

    //$app->get();
    $app->post('/test', \Controllers\PhotoController::class . ':test');
    //$app->post('/avatar', '');

});