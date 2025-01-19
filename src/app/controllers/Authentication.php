<?php

class Authentication 
{
    use Controller;

    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
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

            if (Utils::hasEmptyFields([$email, $password])) {
                $_SESSION['error'] = 'Toate câmpurile sunt obligatorii.';
                header('Location: ' . ROOT . '/authentication/login');
                exit;
            }

            $user = $this->userModel->select_first(['email' => $email]);

            if ($user && Utils::verifyPassword($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_type'] = $user->type;
                header('Location: ' . ROOT . '/' .$user->type);

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

            if (Utils::hasEmptyFields($data)) {
                $_SESSION['error'] = 'Toate câmpurile sunt obligatorii.';
                header('Location: ' . ROOT . '/authentication/register');
                exit;
            }

            if (Utils::emailExists($email, $this->userModel)) {
                $_SESSION['error'] = 'Exista deja un cont pe aceasta adresa de email.';
                header('Location: ' . ROOT . '/authentication/register');
                exit;
            }

            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Parolele nu se potrivesc.';
                header('Location: ' . ROOT . '/authentication/register');
                exit;
            }

            if (!Utils::isPasswordStrong($password)) {
                $_SESSION['error'] = 'Parola trebuie să aibă cel puțin 8 caractere, cel putin o literă mare și cel putin o cifră.';
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
