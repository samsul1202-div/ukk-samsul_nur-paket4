<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Sistem Perpustakaan'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
        }
        .sidebar .nav-link:hover {
            color: #fff;
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: #0d6efd;
        }
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }
        .dashboard-admin,
        .dashboard-user {
            margin-left: -250px !important;
            padding-left: 250px !important;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
            .dashboard-admin,
            .dashboard-user {
                margin-left: 0 !important;
                padding-left: 0 !important;
            }
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar p-3" style="width: 250px;">
            <h5 class="text-white mb-4">
                <i class="fas fa-book"></i> Perpustakaan
            </h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/dashboard">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>

                <?php if ($_SESSION['role'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/book">
                        <i class="fas fa-book"></i> Kelola Buku
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/member">
                        <i class="fas fa-users"></i> Kelola Anggota
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/borrow">
                        <i class="fas fa-exchange-alt"></i> Kelola Peminjaman
                    </a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/borrow/history">
                        <i class="fas fa-history"></i> Riwayat Peminjaman
                    </a>
                </li>
                <?php if ($_SESSION['role'] !== 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>/borrow/create">
                        <i class="fas fa-plus"></i> Pinjam Buku
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="<?php echo BASE_URL; ?>/auth/logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <?php if (isset($_SESSION['user_id'])): ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1"><?php echo $data['title'] ?? 'Dashboard'; ?></span>
                <div class="d-flex">
                    <span class="navbar-text me-3">
                        <i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?>
                        <span class="badge bg-<?php echo $_SESSION['role'] === 'admin' ? 'primary' : 'secondary'; ?>">
                            <?php echo $_SESSION['role']; ?>
                        </span>
                    </span>
                </div>
            </div>
        </nav>
        <?php endif; ?>

        <div class="container-fluid p-4">
            <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['msg_type'] ?? 'success'; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['msg_type']); ?>
            <?php endif; ?>

            <?php
            // Include the actual view file
            if (isset($data['viewPath'])) {
                $viewFile = __DIR__ . '/../' . $data['viewPath'] . '.php';
                if (file_exists($viewFile)) {
                    require_once $viewFile;
                } else {
                    echo '<div class="alert alert-danger">View file not found: ' . htmlspecialchars($data['viewPath']) . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger">View path not set</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>