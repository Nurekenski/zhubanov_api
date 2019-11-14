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
    // 'db_host' => 's54ham9zz83czkff.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', //mysql_db
    // 'db_name' => 'hbfgzac4mph8fin1',
    // 'db_user' => 'ib5eure8yvj2adw6',
    // 'db_password' => 's93gjjl492k1wwp4'
    
    'db_host' => 'localhost', //mysql_db
    'db_name' => 'qazlatin',
    'db_user' => 'root',
    'db_password' => ''
];
