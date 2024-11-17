<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
  define('ROOT', 'http://localhost:9000/public');
else 
  define('ROOT', 'https://www.example.com');
