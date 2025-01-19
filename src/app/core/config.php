<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
  define('ROOT', 'http://localhost:9000/public');
else 
  define('ROOT', 'https://www.example.com');

define('APP_NAME', "Apple Records");
define('APP_DESC', "The Official Record Label of The Beatles");

define('DEBUG', true);
