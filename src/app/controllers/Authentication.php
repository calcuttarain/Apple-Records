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

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . ROOT);
        exit;
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

            if (!$user or !Utils::verifyPassword($password, $user->password)) {
                $_SESSION['error'] = 'Email sau parolă incorectă.';
                header('Location: ' . ROOT . '/authentication/login');
                exit;
            }

            if (!$user->verified) {
                $_SESSION['error'] = 'Contul nu este verificat. Vă rugăm să vă verificați email-ul pentru link-ul de confirmare.';
                $_SESSION['email'] = $user->email;
                header('Location: ' . ROOT . '/authentication/token');
                exit;
            }

            $_SESSION['user_id'] = $user->id;
            $_SESSION['email'] = $user->email;

            switch ($user->type) {
                case 'admin':
                    $_SESSION['user_type'] = 'admin';
                    header('Location: ' . ROOT . '/admin');
                    break;
                case 'band_member':
                    $_SESSION['user_type'] = 'band_member';
                    header('Location: ' . ROOT . '/band_member');
                    break;
                case 'customer':
                    $_SESSION['user_type'] = 'customer';
                    header('Location: ' . ROOT . '/customer');
                    break;
                case 'staff':
                    $_SESSION['user_type'] = 'staff';
                    header('Location: ' . ROOT . '/staff');
                    break;
                default:
                    $_SESSION['error'] = 'Rol necunoscut. Contactați administratorul.';
                    header('Location: ' . ROOT . '/authentication/login');
                    exit;
            }
            exit;
        }
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = Utils::sanitize($_POST);

            $first_name = $data['first_name'] ?? '';
            $last_name = $data['last_name'] ?? '';
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
            $token = bin2hex(random_bytes(16));

            $data['password'] = $hashed_password;
            $data['token'] = $token;
            $data['verified'] = 0;

            $this->userModel->insert($data);

            $_SESSION['email'] = $email; 

            $statsModel = new StatsModel();
            $stats = $statsModel->incrementUsersCount();

            try {
                $emailService = new EmailService();
                $emailService->sendVerificationToken($email, $first_name . ' ' . $last_name, $token);

                $_SESSION['success'] = 'Tokenul a fost trimis pe adresa de e-mail.';
                header('Location: ' . ROOT . '/authentication/token');
                exit;
            } catch (Exception $e) {
                $_SESSION['error'] = 'Eroare la trimiterea e-mailului: ' . $e->getMessage();
                header('Location: ' . ROOT . '/authentication/register');
                exit;
            }
        }
    }

    public function token()
    {
        $this->view('token');
    }

    public function verifyToken()
    {
        $token = $_GET['token'] ?? null; 
        $email = $_SESSION['email'] ?? null; 

        if (!$email) {
            $_SESSION['error'] = 'Eroare: Adresa de email nu este stocată. Reîncepe procesul.';
            header('Location: ' . ROOT . '/authentication/register');
            exit;
        }

        if (!$token) {
            $_SESSION['error'] = 'Tokenul lipsește. Verifică email-ul pentru linkul de verificare.';
            header('Location: ' . ROOT . '/authentication/token');
            exit;
        }

        $user = $this->userModel->select_first(['email' => $email, 'token' => $token]);

        if (!$user) {
            $_SESSION['error'] = 'Token invalid sau expirat.';
            header('Location: ' . ROOT . '/authentication/token');
            exit;
        }

        $this->userModel->update($user->id, [
            'verified' => 1,
            'token' => null
        ]);

        $_SESSION['success'] = 'Cont verificat cu succes. Acum vă puteți autentifica.';
        header('Location: ' . ROOT . '/authentication/login');
        exit;
    }

   public function resendToken()
   {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_SESSION['email'] ?? null;

            if (!$email) {
                $_SESSION['error'] = 'Eroare: Adresa de email nu a fost corect stocată. Reîncepe procesul de verificare a e-mailului.';
                header('Location: ' . ROOT . '/authentication/login');
                exit;
            }

            $user = $this->userModel->select_first(['email' => $email]);

            if (!$user) {
                $_SESSION['error'] = 'Email invalid.';
                header('Location: ' . ROOT . '/authentication/token');
                exit;
            }

            if ($user->verified) {
                $_SESSION['error'] = 'Contul este deja verificat.';
                header('Location: ' . ROOT . '/authentication/login');
                exit;
            }

            $token = bin2hex(random_bytes(16));
            $this->userModel->update($user->id, ['token' => $token]);

            try {
                $emailService = new EmailService();
                $emailService->sendVerificationToken($email, $user->first_name . ' ' . $user->last_name, $token);

                $_SESSION['success'] = 'Tokenul a fost retrimis pe adresa de e-mail.';
                header('Location: ' . ROOT . '/authentication/token');
                exit;
            } catch (Exception $e) {
                $_SESSION['error'] = 'Eroare la trimiterea e-mailului: ' . $e->getMessage();
                header('Location: ' . ROOT . '/authentication/token');
                exit;
            }
        }
    }
}
