<?php

class Book extends Controller
{
    public function index()
    {
        $this->checkAdmin();

        $bookModel = $this->model('BookModel');
        $books = $bookModel->getAllBooks();

        $this->view('books/index', [
            'title' => 'Kelola Buku',
            'books' => $books
        ]);
    }

    public function create()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $pengarang = $_POST['pengarang'] ?? '';
            $penerbit = $_POST['penerbit'] ?? '';
            $isbn = $_POST['isbn'] ?? '';
            $tahun_terbit = $_POST['tahun_terbit'] ?? '';
            $kategori = $_POST['kategori'] ?? '';
            $stok = (int)($_POST['stok'] ?? 0);

            $bookModel = $this->model('BookModel');

            if ($bookModel->addBook($judul, $pengarang, $penerbit, $isbn, $tahun_terbit, $kategori, $stok)) {
                $this->redirectWithMessage('book', 'Buku berhasil ditambahkan!');
            } else {
                $this->view('books/create', ['error' => 'Gagal menambahkan buku']);
            }
            return;
        }

        $this->view('books/create', ['title' => 'Tambah Buku']);
    }

    public function edit($id)
    {
        $this->checkAdmin();

        $bookModel = $this->model('BookModel');
        $book = $bookModel->getBookById($id);

        if (!$book) {
            $this->redirectWithMessage('book', 'Buku tidak ditemukan', 'error');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $pengarang = $_POST['pengarang'] ?? '';
            $penerbit = $_POST['penerbit'] ?? '';
            $isbn = $_POST['isbn'] ?? '';
            $tahun_terbit = $_POST['tahun_terbit'] ?? '';
            $kategori = $_POST['kategori'] ?? '';
            $stok = (int)($_POST['stok'] ?? 0);

            if ($bookModel->updateBook($id, $judul, $pengarang, $penerbit, $isbn, $tahun_terbit, $kategori, $stok)) {
                $this->redirectWithMessage('book', 'Buku berhasil diupdate!');
            } else {
                $this->view('books/edit', ['error' => 'Gagal mengupdate buku', 'book' => $book]);
            }
            return;
        }

        $this->view('books/edit', [
            'title' => 'Edit Buku',
            'book' => $book
        ]);
    }

    public function delete($id)
    {
        $this->checkAdmin();

        $bookModel = $this->model('BookModel');

        if ($bookModel->deleteBook($id)) {
            $this->redirectWithMessage('book', 'Buku berhasil dihapus!');
        } else {
            $this->redirectWithMessage('book', 'Gagal menghapus buku', 'error');
        }
    }

    public function search()
    {
        $this->checkLogin();

        $keyword = $_GET['keyword'] ?? '';

        if (empty($keyword)) {
            $this->redirect('dashboard');
        }

        $bookModel = $this->model('BookModel');
        $books = $bookModel->searchBooks($keyword);

        $this->view('books/search', [
            'title' => 'Hasil Pencarian',
            'books' => $books,
            'keyword' => $keyword
        ]);
    }
}