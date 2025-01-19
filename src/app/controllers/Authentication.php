<?php

class Authentication 
{
    use Controller;

    public function index()
    {
        $this->view('login');
    }

    public function login()
    {
        $this->view('login');
    }

    public function register()
    {
        $this->view('register');
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $model = new User();
            $user = $model->select_first(['email' => $email]);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_type'] = $user->type;
                header('Location: ' . ROOT);

                exit;
            } else {
                $_SESSION['error'] = 'Email sau parolă incorectă.';
                header('Location: ' . ROOT . '/authentication/login');
                exit;
            }
        }
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $type = $_POST['type'] ?? 'customer';

            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Parolele nu se potrivesc.';
                header('Location: ' . ROOT . '/authentication/register');
                exit;
            }

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $user = new User;
            $user->insert([
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password,
                'type' => ucfirst($type)
            ]);

            $_SESSION['success'] = 'Cont creat cu succes. Acum te poți autentifica.';
            header('Location: ' . ROOT . '/authentication/login');
            exit;
        }
    }
}

