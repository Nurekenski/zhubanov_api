<?php

$serverEnv = getenv('PRODUCTION');

if ($serverEnv) {
    return [
        'db_host' => getenv('DB_HOST'),
        'db_name' => getenv('DB_NAME'),
        'db_user' => getenv('DB_USER'),
        'db_password' => getenv('DB_PASSWORD')
    ];
}

return [
    'db_host' => 'mysql_db',
    'db_name' => 'api',
    'db_user' => 'root',
    'db_password' => '123456999'
];
