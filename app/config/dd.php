<?php

/**
 * @param $data
 * @param string $message
 */
function dd($data, $message = "")
{
    var_dump($data);
    die($message);
}


/**
 * @param $data
 * @param string $message
 */
function pe($data, $message = "")
{
    print_r($data);
    exit($message);
}