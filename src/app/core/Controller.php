<?php

trait Controller{
    public function view($name, $data = [], $category = null)
    {
        $filename = $category 
            ? __DIR__ . "/../views/$category/$name.view.php" 
            : __DIR__ . "/../views/$name.view.php";

        if (!file_exists($filename)) {
            $filename = __DIR__ . '/../views/404.view.php';
        }


        extract($data);
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
