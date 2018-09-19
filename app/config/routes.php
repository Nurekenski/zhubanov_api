<?php

use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;


$app->group('/v2', function () use ($app) {

    // LOGIN ROUTE
    $translator = function($message){
        $messages = [
            '{{name}} must have a length between {{minValue}} and {{maxValue}}' => 'must be longer than 6 characters',
            '{{name}} must not contain whitespace' => 'must not space',
            '{{name}} must be a valid telephone number' => '{{name}} must be a valid telephone number'
        ];
        return $messages[$message];
    };

    $loginValidator = [
        'phone' => v::phone(),
        'password' => v::noWhitespace()->notEmpty()->length(6, 36)
    ];
    $app->post('/login[/]', \Controllers\LoginController::class . ':signIn')
        ->add(new Validation($loginValidator, $translator));


    // SIGNUP ROUTE
    $app->group('/signup', function () use ($app) {

        $signupValidator = [
            'phone' => v::phone()
        ];
        $app->post('/', \Controllers\SignupController::class . ':signUp')
            ->add(new \Middleware\SpamControl())
            ->add(new Validation($signupValidator));

        $signupVerifyPhoneValidator = [
            'phone' => v::phone(),
            'code' => v::numeric()->positive()->between(10000, 99999)
        ];
        $app->post('/verify-phone[/]', \Controllers\SignupController::class . ':signUpVerifyPhone')
            ->add(new Validation($signupVerifyPhoneValidator));

        $app->post('/data[/]', \Controllers\SignupController::class . ':signUpData')
            ->add(new \Middleware\JWT\TempAuth());

    });

});
