<?php
require '../app/core/init.php';

session_start();

$router = new Router;

$router->load_controller();
