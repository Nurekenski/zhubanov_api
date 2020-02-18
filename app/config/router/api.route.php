<?php
use DavidePastore\Slim\Validation\Validation;
use Respect\Validation\Validator as v;

// SIGNUP ROUTE

$app->group('/api', function () use ($app) {
    $order = [
        "name" => v::notEmpty(),
        "phone" => v::notEmpty(),
        "type" => v::notEmpty(),
        "email" => v::notEmpty()->email(),
    ];

    $app->post('/insert[/]', \Controllers\ApiController::class . ':insert')
        ->add(new Validation($order));

    $app->get('/get[/]', \Controllers\ApiController::class . ':get');

    $app->post('/akeac_insert[/]', \Controllers\ApiController::class . ':insertAkeac')
    ->add(new Validation($order));


});



?>