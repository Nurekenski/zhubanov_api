<?php
use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;

// SIGNUP ROUTE

$app->group('/signup', function () use ($app) {




    $forgotPassword = [
        "iin" => v::noWhitespace()->notEmpty()->length(12, 12),
        "phone" => v::noWhitespace()->notEmpty(),
        "password" => v::noWhitespace()->notEmpty(),
      
    ];

    $app->post('/forgot_password[/]', \Controllers\SignupController::class . ':forgotPassword')
        // ->add(new \Middleware\JWT\TempAuth())
        ->add(new Validation($forgotPassword));


    $signupData = [
        // "surname" => v::noWhitespace()->notEmpty(),
        // "name" => v::noWhitespace()->notEmpty(),
        // "third_name" => v::noWhitespace()->notEmpty(),
      
    ];

    $app->post('/registration[/]', \Controllers\SignupController::class . ':registration')
        ->add(new \Middleware\JWT\TempAuth());
        // ->add(new Validation($signupData));

    $signupValidator = [
        "username" => v::noWhitespace()->notEmpty(),
        "name" => v::noWhitespace()->notEmpty(),
        "surname" => v::noWhitespace()->notEmpty(),
        "email" => v::email(),
        "password"=> v::noWhitespace()->notEmpty()->length(6, 36),
        "phone" =>  v::noWhitespace()->notEmpty()
    ];

    // $app->post('[/]', \Controllers\SignupController::class . ':signUp')
    //     ->add(new \Middleware\SpamControl())
    //     ->add(new Validation($signupValidator));
     // end 


    $signupVerifyPhoneValidator = [
        'phone' => v::phone() 
    ];

    $loginValidator = [
        'iin' => v::noWhitespace()->notEmpty()->length(12,12),
        'password' => v::noWhitespace()->notEmpty()->length(6,36)
    ];
    
    $app->post('/get_all[/]', \Controllers\SignupController::class . ':getAll')
    ->add(new \Middleware\JWT\StudentData());


    $app->post('/student_registration[/]', \Controllers\SignupController::class . ':studentRegistration')
    ->add(new Validation($loginValidator));

    $app->post('/student_login[/]', \Controllers\SignupController::class . ':studentLogin')
    ->add(new Validation($loginValidator));

    $app->post('/first_step_registration[/]', \Controllers\SignupController::class . ':signUpPhone')
        ->add(new Validation($signupVerifyPhoneValidator));

    // end 
    $signupVerifyPhoneValidator = [
        'phone' => v::phone(),
        'code' => v::numeric()->positive()->between(10000, 99999)
    ];

    $app->post('/verify_phone[/]', \Controllers\SignupController::class . ':signUpVerifyPhone')
        ->add(new Validation($signupVerifyPhoneValidator));
   
   
    $password_check = [
        'password' => v::noWhitespace()->notEmpty()
    ];

    $app->post('/set_password[/]', \Controllers\SignupController::class . ':setPassword')
        ->add(new \Middleware\JWT\TempAuth())
        ->add(new Validation($password_check));
    });
    