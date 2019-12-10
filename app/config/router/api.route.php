<?php
use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;

// SIGNUP ROUTE

$app->group('/api', function () use ($app) {
    $order = [
        "name" => v::notEmpty(),
        "email" => v::notEmpty()->email(),
        "comment" => v::notEmpty(),
    ];

    $app->post('/insert[/]', \Controllers\ApiController::class . ':insert')
        ->add(new Validation($order));

    $app->get('/get[/]', \Controllers\ApiController::class . ':get');
});



?>