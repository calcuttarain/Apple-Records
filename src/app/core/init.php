<?php

spl_autoload_register(function($classname) {
    if (class_exists($classname, false)) {
        return;
    }

    $filename = "../app/models/" . ucfirst($classname) . ".php";
    if (file_exists($filename)) {
        require $filename;
    }

    else {
        $filename = "../app/controllers/" . ucfirst($classname) . ".php";
        if (file_exists($filename)) {
            require $filename;
        }
    }
});

require 'config.php';

require 'EmailService.php';
require 'Utils.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'View.php';

require 'Router.php';
