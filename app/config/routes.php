<?php

use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;


$app->group('/v2', function () use ($app) {

    // LOGIN ROUTE
    $loginValidator = [
        'phone' => v::phone(),
        'password' => v::alnum()->noWhitespace()->length(6, 36)
    ];

    $app->post('/login[/]', \Controllers\LoginController::class . ':signIn')
        ->add(new Validation($loginValidator));



    // SIGNUP ROUTE
    $app->group('/signup', function () use ($app) {
        $signupValidator = [
            'phone' => v::phone()
        ];

        $app->post('/', \Controllers\SignupController::class . ':signUp')
            ->add(new \Middleware\SpamControl())
            ->add(new Validation($signupValidator));
    });

});
