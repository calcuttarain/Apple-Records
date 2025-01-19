<?php
require '../app/core/init.php';

session_start();

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$router = new Router;
$router->load_controller();
