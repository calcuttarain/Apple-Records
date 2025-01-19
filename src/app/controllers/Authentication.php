<?php

class Authentication 
{
    use Controller;

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

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
            $data = Utils::sanitize($_POST);

            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';

            $user = $this->userModel->select_first(['email' => $email]);

            if ($user && Utils::verifyPassword($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_type'] = $user->type;
                header('Location: ' . ROOT);

                exit;
            } 
            else {
                $_SESSION['error'] = 'Email sau parolă incorectă.';
                header('Location: ' . ROOT . '/authentication/login');
                exit;
            }
        }
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = Utils::sanitize($_POST);

            $name = $data['name'] ?? '';
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';
            $confirm_password = $data['confirm_password'] ?? '';
            $type = $data['type'] ?? 'customer';

            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Parolele nu se potrivesc.';
                header('Location: ' . ROOT . '/authentication/register');
                exit;
            }

            $hashed_password = Utils::hashPassword($password);
            $data['password'] = $hashed_password;

            $this->userModel->insert($data);

            $_SESSION['success'] = 'Cont creat cu succes. Acum te poți autentifica.';
            header('Location: ' . ROOT . '/authentication/login');
            exit;
        }
    }
}
