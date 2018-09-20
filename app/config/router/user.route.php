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


    $app->put('[/]', \Controllers\UserController::class . ':edit')
        ->add(new \Middleware\JWT\Auth());
    // end


});