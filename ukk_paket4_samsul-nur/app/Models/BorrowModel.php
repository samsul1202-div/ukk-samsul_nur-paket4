<?php

require_once __DIR__ . '/../Config/Database.php';

class BorrowModel
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Borrow book
    public function borrowBook($user_id, $book_id, $tanggal_kembali_target)
    {
        $tanggal_peminjaman = date('Y-m-d');

        $stmt = $this->db->prepare("INSERT INTO borrows (user_id, book_id, tanggal_peminjaman, tanggal_kembali_target, status) VALUES (?, ?, ?, ?, 'active')");
        $stmt->bind_param("iiss", $user_id, $book_id, $tanggal_peminjaman, $tanggal_kembali_target);

        if ($stmt->execute()) {
            $bookModel = new BookModel();
            $bookModel->decreaseStok($book_id);
            return true;
        }

        return false;
    }

    // Return book
    public function returnBook($borrow_id, $kondisi = 'baik')
    {
        $tanggal_dikembalikan = date('Y-m-d');

        $stmt = $this->db->prepare("UPDATE borrows SET status = 'returned', tanggal_dikembalikan = ?, kondisi = ? WHERE id = ?");
        $stmt->bind_param("ssi", $tanggal_dikembalikan, $kondisi, $borrow_id);

        if ($stmt->execute()) {
            // Get book_id and increase stock
            $borrow = $this->getBorrowById($borrow_id);
            $bookModel = new BookModel();
            $bookModel->increaseStok($borrow['book_id']);
            return true;
        }

        return false;
    }

    // Get borrow by ID
    public function getBorrowById($id)
    {
        $stmt = $this->db->prepare("
            SELECT b.*, bk.judul as book_judul
            FROM borrows b
            JOIN books bk ON b.book_id = bk.id
            WHERE b.id = ?
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Get all borrows (admin)
    public function getAllBorrows()
    {
        $result = $this->db->query("
            SELECT b.*, u.nama as user_nama, bk.judul as book_judul
            FROM borrows b
            JOIN users u ON b.user_id = u.id
            JOIN books bk ON b.book_id = bk.id
            ORDER BY b.tanggal_peminjaman DESC
        ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get user's active borrows
    public function getUserActiveBorrows($user_id)
    {
        $stmt = $this->db->prepare("
            SELECT b.*, bk.judul as book_judul
            FROM borrows b
            JOIN books bk ON b.book_id = bk.id
            WHERE b.user_id = ? AND b.status = 'active'
            ORDER BY b.tanggal_peminjaman DESC
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Get user's borrow history
    public function getUserBorrowHistory($user_id)
    {
        $stmt = $this->db->prepare("
            SELECT b.*, bk.judul as book_judul
            FROM borrows b
            JOIN books bk ON b.book_id = bk.id
            WHERE b.user_id = ?
            ORDER BY b.tanggal_peminjaman DESC
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Check late borrows
    public function getLateBorrows()
    {
        $today = date('Y-m-d');
        $result = $this->db->query("
            SELECT b.*, u.nama as user_nama, bk.judul as book_judul
            FROM borrows b
            JOIN users u ON b.user_id = u.id
            JOIN books bk ON b.book_id = bk.id
            WHERE b.status = 'active' AND b.tanggal_kembali_target < '$today'
            ORDER BY b.tanggal_kembali_target ASC
        ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
