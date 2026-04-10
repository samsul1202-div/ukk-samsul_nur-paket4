<?php

require_once __DIR__ . '/../Config/Database.php';

class BookModel
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Add book
    public function addBook($judul, $pengarang, $penerbit, $isbn, $tahun_terbit, $kategori, $stok)
    {
        $stmt = $this->db->prepare("INSERT INTO books (judul, pengarang, penerbit, isbn, tahun_terbit, kategori, stok) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $judul, $pengarang, $penerbit, $isbn, $tahun_terbit, $kategori, $stok);
        return $stmt->execute();
    }

    // Get all books
    public function getAllBooks()
    {
        $result = $this->db->query("SELECT * FROM books ORDER BY judul ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get book by ID
    public function getBookById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Search books
    public function searchBooks($keyword)
    {
        $keyword = '%' . $keyword . '%';
        $stmt = $this->db->prepare("SELECT * FROM books WHERE judul LIKE ? OR pengarang LIKE ? OR kategori LIKE ? ORDER BY judul ASC");
        $stmt->bind_param("sss", $keyword, $keyword, $keyword);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Update book
    public function updateBook($id, $judul, $pengarang, $penerbit, $isbn, $tahun_terbit, $kategori, $stok)
    {
        $stmt = $this->db->prepare("UPDATE books SET judul = ?, pengarang = ?, penerbit = ?, isbn = ?, tahun_terbit = ?, kategori = ?, stok = ? WHERE id = ?");
        $stmt->bind_param("ssssssii", $judul, $pengarang, $penerbit, $isbn, $tahun_terbit, $kategori, $stok, $id);
        return $stmt->execute();
    }

    // Delete book
    public function deleteBook($id)
    {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Get available books (stok > 0)
    public function getAvailableBooks()
    {
        $result = $this->db->query("SELECT * FROM books WHERE stok > 0 ORDER BY judul ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Decrease stok
    public function decreaseStok($book_id)
    {
        $stmt = $this->db->prepare("UPDATE books SET stok = stok - 1 WHERE id = ? AND stok > 0");
        $stmt->bind_param("i", $book_id);
        return $stmt->execute();
    }

    // Increase stok
    public function increaseStok($book_id)
    {
        $stmt = $this->db->prepare("UPDATE books SET stok = stok + 1 WHERE id = ?");
        $stmt->bind_param("i", $book_id);
        return $stmt->execute();
    }
}
