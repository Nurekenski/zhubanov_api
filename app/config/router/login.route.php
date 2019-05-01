<?php

use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;

// LOGIN ROUTE
$loginValidator = [
    'phone' => v::noWhitespace()->notEmpty(),
    'password' => v::noWhitespace()->notEmpty()->length(6, 36)
];

$app->post('/login[/]', \Controllers\LoginController::class . ':signIn')
    ->add(new Validation($loginValidator));