<?php

class Router{
      private $controller = 'Home';
      private $method = 'index';

      private function split_url()
      {
            $URL = $_GET['url'] ?? 'home';
            $URL = explode('/', $URL);
            return $URL;
      }

      public function load_controller()
      {
            $URL = $this->split_url();
            $filename = '../app/controllers/'.ucfirst($URL[0]).'.php';

            if(file_exists($filename)) {
                  $this->controller = ucfirst($URL[0]);
                  unset($URL[0]);
            }
            else {
                  $filename = '../app/controllers/_404.php';
                  $this->controller = '_404';
            }

            require $filename;

            $controller = new $this->controller;

            if(!empty($URL[1]))
            {
                if(method_exists($controller, $URL[1]))
                {
                    $this->method = $URL[1];
                    unset($URL[1]);
                }	
            }

            call_user_func_array([$controller, $this->method], $URL);
      }
}
