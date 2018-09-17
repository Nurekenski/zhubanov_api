<?php

/**
 * @param $array
 * @param $message
 */
function dd($data, $message = "")
{
    var_dump($data);
    die($message);
}


/**
 * @param $array
 * @param string $message
 */
function pe($data, $message = "")
{
    print_r($data);
    exit($message);
}