<?php

$serverEnv = getenv('PRODUCTION');

if (APP_ENV) {
    return [
        'db_host' => getenv('DB_HOST'),
        'db_name' => getenv('DB_NAME'),
        'db_user' => getenv('DB_USER'),
        'db_password' => getenv('DB_PASSWORD')
    ];
}

return [
     'db_host' => 'icopoghru9oezxh8.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', //mysql_db
    'db_name' => 'x5ccvtlbghqbj0d5',
    'db_user' => 'vrb92ie5xi4qhz6s',
    'db_password' => 'huoot8y78297oafx'
    //     'db_host' => 'localhost', //mysql_db
//     'db_name' => 'data',
//     'db_user' => 'root',
//     'db_password' => ''
];
