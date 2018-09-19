<?php

define('DEBUG', true);
define('APP_ENV', getenv('APP_ENV'));

define('NOTIFICATION_SERVER', 'https://otau.org/notification');

if(APP_ENV == 'production') {
    define('MATRIX_SERVER', 'https://api.msg.otau.org');
    define('ACCOUNT_SERVER', 'https://api.account.otau.org');
}

elseif(APP_ENV == 'stage') {
    define('MATRIX_SERVER', 'http://api.msg.stage.otau.org');
    define('ACCOUNT_SERVER', 'http://api.account.stage.otau.org');

} else {
    define('MATRIX_SERVER', 'https://api.msg.otau.org');
    define('ACCOUNT_SERVER', 'http://new.loc');
}


if(APP_ENV) {
    define('PG_HOST', getenv('PG_HOST'));
    define('PG_PORT', getenv('PG_PORT'));

    define('JWT_SECRET', getenv("JWT_SECRET"));
}
else {
    define('PG_HOST', '104.248.29.151');
    define('PG_PORT', '32785');

    define('JWT_SECRET', '@@@123456@@@');
}


define('ISSUE', 'account.otau.org');
define('EXP_TIME', 30 * 24 * 60 * 60);

define('STRING',  '1');
define('INTEGER', '2');
define('BOOLEAN', '3');


// api errors
define('UNEXPECTED_ERROR', 0);

define('NO_VALIDATE_PARAMETER',       12);

define('USER_ERROR',                  100);
define('INVALID_LOGIN_OR_PASSWORD',   101);
define('USER_EXIST',                  102);

define('PASSWORD_ERROR',              111);
define('CODE_ERROR',                  110);

define('USER_LIMIT',                  40);
define('AVATAR_ERROR',                45);



// html errors
define('OK',                          200);
define('BAD_REQUEST',                 400);
define('FORBIDDEN',                   403);
define('UNAUTHORIZED',                401);
define('NOT_FOUND',                   404);
define('INTERNAL_SERVER_ERROR',       500);
