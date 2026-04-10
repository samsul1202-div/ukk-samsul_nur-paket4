<?php

class Controller
{
    public function view($view, $data = [])
    {
        // Extract data to make variables available in view
        extract($data);

        // Set the view path for the layout
        $data['viewPath'] = $view;

        // Include layout
        require_once __DIR__ . '/../Views/layout/main.php';
    }

    public function model($model)
    {
        require_once __DIR__ . '/../Models/' . $model . '.php';
        return new $model();
    }

    protected function redirect($page)
    {
        header('Location: ' . BASE_URL . '/' . $page);
        exit();
    }

    protected function redirectWithMessage($page, $message, $type = 'success')
    {
        $_SESSION['message'] = $message;
        $_SESSION['msg_type'] = $type;
        header('Location: ' . BASE_URL . '/' . $page);
        exit();
    }

    protected function checkLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
    }

    protected function checkAdmin()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $this->redirect('auth/login');
        }
    }
}
