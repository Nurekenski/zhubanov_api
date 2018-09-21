<?php

$app->post('/encode/sayrus[/]', \Controllers\TestController::class . ':encodeToken');

$app->get('/test-sms[/]', \Controllers\TestController::class . ':testSMS');
