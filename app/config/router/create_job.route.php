<?php
use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;

// SIGNUP ROUTE

$app->group('/insert_data', function () use ($app) {

    $app->get('/statisticslatin[/]', \Controllers\SignupController::class . ':getStatistics');

    $app->post('/sign[/]', \Controllers\SignupController::class . ':signIn');
    
    $app->post('/pushtestresult[/]', \Controllers\SignupController::class . ':PushTest');
    
    $app->post('/push_after_registration[/]', \Controllers\SignupController::class . ':PushAfterRegistration');
    
    $app->post('/gettestresults[/]', \Controllers\SignupController::class . ':getTest');

    $app->get('/getlatinwords[/]', \Controllers\SignupController::class . ':getLatin');

    $app->post('/insert[/]', \Controllers\SignupController::class . ':insertLatinData');
    // ->add(new \Middleware\JWT\TempAuth())
    // ->add(new Validation($order));

    $app->post('/all_orders[/]', \Controllers\SignupController::class . ':getAllOrder');
        // ->add(new \Middleware\JWT\TempAuth())
        // ->add(new Validation($order));


    $order = [
        "name" => v::notEmpty(),
        "phone" => v::notEmpty(),
        "adress" => v::notEmpty(),
        "comment" => v::notEmpty(),
        "who" => v::notEmpty(),
    ];

    $app->post('/get_order[/]', \Controllers\SignupController::class . ':getOrder')
        // ->add(new \Middleware\JWT\TempAuth())
        ->add(new Validation($order));



    $order = [
        "product_name" => v::notEmpty(),
        "amount" => v::notEmpty(),
        "cost" => v::notEmpty(),
        "who" => v::notEmpty(),
    ];
    $app->post('/get_order_product[/]', \Controllers\SignupController::class . ':getOrderProduct')
        // ->add(new \Middleware\JWT\TempAuth())
        ->add(new Validation($order)); 




    $jobGetDataValidator = [
        'ids' => v::notEmpty()
    ];

    $app->post('/statistics[/]', \Controllers\SignupController::class . ':getStatistics')
    ->add(new \Middleware\JWT\CheckForData());

    
    $app->get('/getdata[/]', \Controllers\SignupController::class . ':get')
        // ->add(new \Middleware\JWT\JobAuth())
        ->add(new Validation($jobGetDataValidator));


    $jobSearchDataValidator = [
        'product_name' => v::notEmpty()
    ];


    $app->get('/search[/]', \Controllers\SignupController::class . ':searchData')
        // ->add(new \Middleware\JWT\JobAuth())
        ->add(new Validation($jobSearchDataValidator));
    
    
    // $jobSearchDataValidator = [
    //     'name' => v::notEmpty()

    // ];


    $app->get('/search_all[/]', \Controllers\SignupController::class . ':searchDataAll');
        // ->add(new \Middleware\JWT\JobAuth())
        // ->add(new Validation($jobSearchDataValidator));

    // end 
    $createJobData = [
        "product_name" => v::noWhitespace()->notEmpty(),
        "description" => v::noWhitespace()->notEmpty(),
        "cost" => v::notEmpty()
    ];

    $app->post('[/]', \Controllers\SignupController::class . ':createJob')
    ->add(new Validation($createJobData));
    // end 

    $insertData = [
        "name"=>v::notEmpty(),
        "surname"=>  v::notEmpty(),
        "third_name"=> v::notEmpty(),
        "uroven_knowledge"=> v::notEmpty(),
        "stupen_obuchenie"=> v::notEmpty(),
        "forma_obuchenie" => v::notEmpty(),
        "language_sdachi" => v::notEmpty(),
        "faculty" => v::notEmpty(),
        "specialization"=> v::notEmpty(),
        "spec" =>  v::notEmpty(),
        "osnovanie_dlya_postuplenie"=> v::notEmpty(),
        "who_registered"=> v::notEmpty()
    ];

    $app->post('/all[/]', \Controllers\SignupController::class . ':insertData_all')
    ->add(new \Middleware\JWT\Auth());
    // ->add(new Validation($insertData));
    
    $app->post('/update[/]', \Controllers\SignupController::class . ':update_all')
    ->add(new \Middleware\JWT\Auth());
    // ->add(new Validation($insertData));
    
    $app->post('/student_update[/]', \Controllers\SignupController::class . ':update_all')
    ->add(new \Middleware\JWT\StudentData());
    // ->add(new Validation($insertData));


    $app->post('/student[/]', \Controllers\SignupController::class . ':insertData_all');
    // ->add(new Validation($insertData));
    
    $app->post('/avatar_update[/]', \Controllers\AvatarController::class . ':updateAvatar')
    ->add(new \Middleware\JWT\StudentData());
    
    $app->post('/avatar[/]', \Controllers\AvatarController::class . ':add')
    ->add(new \Middleware\JWT\StudentData());
    // end

    $app->get('/avatar[/]', \Controllers\AvatarController::class . ':get');
        // ->add(new \Middleware\JWT\StudentData());
    // end

    $app->post('/get_data[/]', \Controllers\SignupController::class . ':getData')
    ->add(new \Middleware\JWT\CheckForData());
    // ->add(new Validation($insertData));

    $app->post('/edit[/]', \Controllers\SignupController::class . ':editData')
    ->add(new \Middleware\JWT\CheckForData());
    // ->add(new Validation($insertData));

});

?>