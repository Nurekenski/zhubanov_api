<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 020 20.09.18
 * Time: 11:38
 */

$app->post('/password/change', \Controllers\PasswordController::class . ':change');

$app->post('/password/verifyCode', \Controllers\PasswordController::class . ':verifyCode');

$app->post('/password/update', \Controllers\PasswordController::class . ':update');

