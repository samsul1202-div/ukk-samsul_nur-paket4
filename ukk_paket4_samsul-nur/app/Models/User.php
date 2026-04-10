<?php

require_once __DIR__ . '/../Config/Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Daftar user baru
    public function register($nama, $email, $password, $role = 'user')
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $email, $hashed_password, $role);

        return $stmt->execute();
    }

    // Login user
    public function login($email, $password)
    {
        $stmt = $this->db->prepare("SELECT id, nama, email, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }

    // Cek email sudah terdaftar
    public function emailExists($email)
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    // Get user by ID
    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Get all users
    public function getAllUsers()
    {
        $result = $this->db->query("SELECT * FROM users WHERE role = 'user' ORDER BY nama ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update user
    public function updateUser($id, $nama, $email)
    {
        $stmt = $this->db->prepare("UPDATE users SET nama = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nama, $email, $id);
        return $stmt->execute();
    }

    // Delete user
    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
