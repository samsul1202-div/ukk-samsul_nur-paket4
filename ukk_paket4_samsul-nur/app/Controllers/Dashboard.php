<?php

class Dashboard extends Controller
{
    public function index()
    {
        $this->checkLogin();

        $borrowModel = $this->model('BorrowModel');
        $bookModel = $this->model('BookModel');
        $userModel = $this->model('User');

        $data = [
            'title' => 'Dashboard',
            'total_books' => count($bookModel->getAllBooks()),
            'total_users' => count($userModel->getAllUsers())
        ];

        if ($_SESSION['role'] === 'admin') {
            $this->view('dashboard/admin', $data);
        } else {
            $data['active_borrows'] = count($borrowModel->getAllBorrows());
            $data['late_borrows'] = count($borrowModel->getLateBorrows());
            $user_borrows = $borrowModel->getUserActiveBorrows($_SESSION['user_id']);
            $data['user_borrows'] = $user_borrows;
            $this->view('dashboard/user', $data);
        }
    }
}