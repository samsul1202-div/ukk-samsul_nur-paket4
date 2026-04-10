<?php

class BorrowController extends Controller
{
    public function index()
    {
        $this->checkAdmin();

        $borrowModel = $this->model('BorrowModel');
        $borrows = $borrowModel->getAllBorrows();

        $this->view('borrows/index', [
            'title' => 'Kelola Peminjaman',
            'borrows' => $borrows
        ]);
    }

    public function create()
    {
        $this->checkLogin();

        if ($_SESSION['role'] === 'admin') {
            // Admin can borrow for any user
            $userModel = $this->model('User');
            $users = $userModel->getAllUsers();
        } else {
            // User can only borrow for themselves
            $users = [['id' => $_SESSION['user_id'], 'nama' => $_SESSION['user_name']]];
        }

        $bookModel = $this->model('BookModel');
        $books = $bookModel->getAvailableBooks();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = (int)($_POST['user_id'] ?? 0);
            $book_id = (int)($_POST['book_id'] ?? 0);
            $tanggal_kembali_target = $_POST['tanggal_kembali_target'] ?? '';

            // Validate user permission
            if ($_SESSION['role'] !== 'admin' && $user_id !== $_SESSION['user_id']) {
                $this->view('borrows/create', [
                    'error' => 'Anda tidak memiliki izin',
                    'users' => $users,
                    'books' => $books
                ]);
                return;
            }

            $borrowModel = $this->model('BorrowModel');

            if ($borrowModel->borrowBook($user_id, $book_id, $tanggal_kembali_target)) {
                $message = $_SESSION['role'] === 'admin' ? 'Peminjaman berhasil dicatat!' : 'Buku berhasil dipinjam!';
                $this->redirectWithMessage('dashboard', $message);
            } else {
                $this->view('borrows/create', [
                    'error' => 'Gagal meminjam buku',
                    'users' => $users,
                    'books' => $books
                ]);
            }
            return;
        }

        $this->view('borrows/create', [
            'title' => 'Pinjam Buku',
            'users' => $users,
            'books' => $books
        ]);
    }

    public function return($id)
    {
        $this->checkLogin();

        $borrowModel = $this->model('BorrowModel');
        $borrow = $borrowModel->getBorrowById($id);

        if (!$borrow) {
            $this->redirectWithMessage('dashboard', 'Peminjaman tidak ditemukan', 'error');
        }

        // Check permission
        if ($_SESSION['role'] !== 'admin' && $borrow['user_id'] !== $_SESSION['user_id']) {
            $this->redirectWithMessage('dashboard', 'Anda tidak memiliki izin', 'error');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kondisi = $_POST['kondisi'] ?? 'baik';

            if ($borrowModel->returnBook($id, $kondisi)) {
                $message = $_SESSION['role'] === 'admin' ? 'Pengembalian berhasil dicatat!' : 'Buku berhasil dikembalikan!';
                $this->redirectWithMessage('dashboard', $message);
            } else {
                $this->view('borrows/return', [
                    'error' => 'Gagal mengembalikan buku',
                    'borrow' => $borrow
                ]);
            }
            return;
        }

        $this->view('borrows/return', [
            'title' => 'Kembalikan Buku',
            'borrow' => $borrow
        ]);
    }

    public function history()
    {
        $this->checkLogin();

        $borrowModel = $this->model('BorrowModel');

        if ($_SESSION['role'] === 'admin') {
            $borrows = $borrowModel->getAllBorrows();
        } else {
            $borrows = $borrowModel->getUserBorrowHistory($_SESSION['user_id']);
        }

        $this->view('borrows/history', [
            'title' => 'Riwayat Peminjaman',
            'borrows' => $borrows
        ]);
    }
}