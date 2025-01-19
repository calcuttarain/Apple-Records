<?php

use Dotenv\Dotenv;

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'http://localhost:9000/public');
} else {
    require_once '../vendor/autoload.php'; 
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    define('ROOT', $_ENV['APP_URL']);
}

define('APP_NAME', $_ENV['APP_NAME'] ?? "Apple Records");
define('APP_DESC', $_ENV['APP_DESC'] ?? "The Official Record Label of The Beatles");

define('DEBUG', $_ENV['DEBUG'] === 'true');

