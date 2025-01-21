<?php

define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
require_once ROOT_PATH . '/../vendor/autoload.php';

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'http://localhost:9000/public');
} else {
    define('ROOT', 'https://www.example.com');
}

define('APP_NAME', "Apple Records");
define('APP_DESC', "The Official Record Label of The Beatles");

define('DEBUG', true);


define('FROM_EMAIL', getenv('FROM_EMAIL'));
define('FROM_NAME', getenv('FROM_NAME'));
define('SMTP_HOST', getenv('SMTP_HOST'));
define('SMTP_PORT', getenv('SMTP_PORT'));
define('SMTP_USER', getenv('SMTP_USER'));
define('SMTP_PASS', getenv('SMTP_PASS'));
