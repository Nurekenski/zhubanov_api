<?php

use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;

// SIGNUP ROUTE
$app->group('/signup', function () use ($app) {
    $signupValidator = [
        'phone' => v::phone()
    ];
    $app->post('/', \Controllers\SignupController::class . ':signUp')
        ->add(new \Middleware\SpamControl())
        ->add(new Validation($signupValidator));
     // end 


    $signupVerifyPhoneValidator = [
        'phone' => v::phone(),
        'code' => v::numeric()->positive()->between(10000, 99999)
    ];
    $app->post('/verify-phone[/]', \Controllers\SignupController::class . ':signUpVerifyPhone')
        ->add(new Validation($signupVerifyPhoneValidator));
    // end 


    $signupData = [
        'password' => v::noWhitespace()->notEmpty()->length(6, 36),
        'name' => v::noWhitespace()->notEmpty(),
        'lastname' => v::noWhitespace()->notEmpty(),
        'birthday' => v::date('Y-m-d'),
        'gender' => v::notEmpty()
    ];
    $app->post('/data[/]', \Controllers\SignupController::class . ':signUpData')
        ->add(new \Middleware\JWT\TempAuth())
        ->add(new Validation($signupData));
    // end 
});