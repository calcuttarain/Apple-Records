<?php

class Router{
      private $controller = 'Home';
      private $method = 'index';


    private function split_url()
    {
        $URL = $_GET['url'] ?? '';
        $URL = trim($URL, '/'); 

        if ($URL === '') {
            return ['Home'];
        }

        return explode('/', $URL);
    }

      public function load_controller()
      {
            $URL = $this->split_url();
            $filename = __DIR__ . '/../controllers/' . ucfirst($URL[0]) . '.php';

            if(file_exists($filename)) {
                  $this->controller = ucfirst($URL[0]);
                  unset($URL[0]);
            }
            else {
                  $filename = __DIR__ . '/../controllers/_404.php';

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

            $this->logUserActivity($this->controller, $this->method);

            call_user_func_array([$controller, $this->method], $URL);
      }

    private function logUserActivity($controller, $method)
    {
        $userId = $_SESSION['user_id'] ?? null;

        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

        $activityModel = new UserActivityModel();
        $activityModel->logAction([
            'user_id'    => $userId,
            'controller' => $controller,
            'method'     => $method,
            'ip_address' => $ipAddress,
        ]);
    }
}
