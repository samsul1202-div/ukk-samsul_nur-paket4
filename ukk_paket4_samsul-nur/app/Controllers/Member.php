<?php

class Member extends Controller
{
    public function index()
    {
        $this->checkAdmin();

        $userModel = $this->model('User');
        $members = $userModel->getAllUsers();

        $this->view('members/index', [
            'title' => 'Kelola Anggota',
            'members' => $members
        ]);
    }

    public function create()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');

            if ($userModel->emailExists($email)) {
                $this->view('members/create', ['error' => 'Email sudah terdaftar']);
                return;
            }

            if ($userModel->register($nama, $email, $password, 'user')) {
                $this->redirectWithMessage('member', 'Anggota berhasil ditambahkan!');
            } else {
                $this->view('members/create', ['error' => 'Gagal menambahkan anggota']);
            }
            return;
        }

        $this->view('members/create', ['title' => 'Tambah Anggota']);
    }

    public function edit($id)
    {
        $this->checkAdmin();

        $userModel = $this->model('User');
        $member = $userModel->getUserById($id);

        if (!$member) {
            $this->redirectWithMessage('member', 'Anggota tidak ditemukan', 'error');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'] ?? '';
            $email = $_POST['email'] ?? '';

            if ($userModel->updateUser($id, $nama, $email)) {
                $this->redirectWithMessage('member', 'Anggota berhasil diupdate!');
            } else {
                $this->view('members/edit', ['error' => 'Gagal mengupdate anggota', 'member' => $member]);
            }
            return;
        }

        $this->view('members/edit', [
            'title' => 'Edit Anggota',
            'member' => $member
        ]);
    }

    public function delete($id)
    {
        $this->checkAdmin();

        $userModel = $this->model('User');

        if ($userModel->deleteUser($id)) {
            $this->redirectWithMessage('member', 'Anggota berhasil dihapus!');
        } else {
            $this->redirectWithMessage('member', 'Gagal menghapus anggota', 'error');
        }
    }
}