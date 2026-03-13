<?php

class AuthController
{
    private $studentModel;

    public function __construct($studentModel)
    {
        $this->studentModel = $studentModel;
    }

    public function showLogin(): void
    {
        if (isset($_SESSION['username'])) {
            redirectTo('index.php?route=students');
        }

        $error = '';
        if (isset($_GET['error'])) {
            if ($_GET['error'] === 'invalid') {
                $error = 'Invalid username or password.';
            } elseif ($_GET['error'] === 'empty') {
                $error = 'Please fill in all fields.';
            }
        }

        view('auth/login', ['error' => $error]);
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirectTo('index.php?route=login');
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            redirectTo('index.php?route=login&error=empty');
        }

        $user = $this->studentModel->findByUsername($username);

        if (!$user || !isset($user['password']) || !password_verify($password, $user['password'])) {
            redirectTo('index.php?route=login&error=invalid');
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['first_name'] . ' ' . $user['last_name'];

        redirectTo('index.php?route=students');
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        redirectTo('index.php?route=login');
    }
}
