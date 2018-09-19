<?php

$app->group('/v2', function () use ($app) {
    foreach (glob(ROOT . "/config/router/*.route.php") as $filename) {
        require $filename;
    }
});
