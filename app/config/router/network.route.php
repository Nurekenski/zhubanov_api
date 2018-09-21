<?php

$app->post('/link/network[/]', \Controllers\NetworkController::class . ':link')
    ->add(new \Middleware\JWT\NetworkAuth());