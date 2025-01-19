<?php

trait Controller{
    public function view($name)
    {
        $filename = '../app/views/'.$name.'.view.php';

        if(!file_exists($filename))
            $filename = '../app/views/404.view.php';

        require $filename;
    }

    public function authorize(array $allowedRoles)
    {
        if (!isset($_SESSION['user_type'])) {
            $_SESSION['error'] = 'Trebuie să fii autentificat pentru a accesa această resursă.';
            header('Location: ' . ROOT . '/authentication');
            exit;
        }

        if (!in_array($_SESSION['user_type'], $allowedRoles)) {
            $_SESSION['error'] = 'Nu ai permisiunea de a accesa această resursă.';
            header('Location: ' . ROOT); 
            exit;
        }
    }
}
