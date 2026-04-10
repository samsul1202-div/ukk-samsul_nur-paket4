<?php

class Auth extends Controller
{
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nama'];
                $_SESSION['role'] = $user['role'];

                $this->redirectWithMessage('dashboard', 'Login berhasil!');
            } else {
                $this->view('auth/login', ['error' => 'Email atau password salah']);
                return;
            }
        }

        $this->view('auth/login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $role = $_POST['role'] ?? 'user';

            // Validasi role
            if (!in_array($role, ['user', 'admin'])) {
                $this->view('auth/register', ['error' => 'Role tidak valid']);
                return;
            }

            if ($password !== $confirm_password) {
                $this->view('auth/register', ['error' => 'Password tidak cocok']);
                return;
            }

            $userModel = $this->model('User');

            if ($userModel->emailExists($email)) {
                $this->view('auth/register', ['error' => 'Email sudah terdaftar']);
                return;
            }

            if ($userModel->register($nama, $email, $password, $role)) {
                $this->redirectWithMessage('auth/login', 'Registrasi berhasil! Silakan login.');
            } else {
                $this->view('auth/register', ['error' => 'Registrasi gagal']);
            }
            return;
        }

        $this->view('auth/register');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('auth/login');
    }
}