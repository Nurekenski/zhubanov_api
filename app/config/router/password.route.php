<?php

use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;

// PASSWORD ROUTE
$app->group('/password', function () use ($app) {

    $passForgotValidator = [
        'phone' => v::phone()
    ];

    $app->post('/forgot[/]', \Controllers\PasswordController::class . ':forgot')
        ->add(new Validation($passForgotValidator));


    $passForgotVerifyPhoneValidator = [
        'phone' => v::phone(),
        'code' => v::numeric()->positive()->between(10000, 99999)
    ];

    $app->post('/forgot/verify-phone[/]', \Controllers\PasswordController::class . ':verifyCode')
        ->add(new Validation($passForgotVerifyPhoneValidator));

    $newPassValidator = [
        'new_password' => v::noWhitespace()->notEmpty()->length(6, 36),
    ];
    $app->put('[/]', \Controllers\PasswordController::class . ':update')
        ->add(new \Middleware\JWT\Auth())
        ->add(new Validation($newPassValidator));
        
});



//$app->post('/password/forgot/verify-phone[/]', \Controllers\PasswordController::class . ':verifyCode');
//
